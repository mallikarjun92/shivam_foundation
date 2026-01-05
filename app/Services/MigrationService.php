<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ReflectionClass;
use Illuminate\Database\Migrations\Migration;

class MigrationService
{
    /**
     * Get all migration files
     */
    public function getMigrationFiles()
    {
        $migrationPath = database_path('migrations');
        $files = File::files($migrationPath);
        
        $migrations = [];
        
        foreach ($files as $file) {
            $migrations[] = [
                'filename' => $file->getFilename(),
                'path' => $file->getPathname(),
                'class' => $this->getClassNameFromFile($file->getPathname()),
                'batch' => $this->getBatchFromFilename($file->getFilename()),
            ];
        }
        
        // Sort by filename (which contains timestamp)
        usort($migrations, function ($a, $b) {
            return strcmp($a['filename'], $b['filename']);
        });
        
        return $migrations;
    }
    
    /**
     * Get migration status (migrations table vs files)
     */
    public function getMigrationStatus()
    {
        $migrationFiles = $this->getMigrationFiles();
        
        // Get migrations that have been run
        $ranMigrations = [];
        if (Schema::hasTable('migrations')) {
            $ranMigrations = DB::table('migrations')->pluck('migration')->toArray();
        }
        
        $status = [];
        
        foreach ($migrationFiles as $migration) {
            $migrationName = pathinfo($migration['filename'], PATHINFO_FILENAME);
            $hasRun = in_array($migrationName, $ranMigrations);
            
            // Get batch if migrated
            $batch = 0;
            if ($hasRun) {
                $migrationRecord = DB::table('migrations')
                    ->where('migration', $migrationName)
                    ->first();
                $batch = $migrationRecord ? $migrationRecord->batch : 0;
            }
            
            $status[] = [
                'migration' => $migrationName,
                'filename' => $migration['filename'],
                'batch' => $batch,
                'status' => $hasRun ? 'Migrated' : 'Pending',
                'class' => $migration['class'],
                'path' => $migration['path'],
            ];
        }
        
        return $status;
    }
    
    /**
     * Extract SQL from migration file using transaction rollback
     */
    public function extractSqlFromMigration($migrationPath, $direction = 'up')
    {
        try {
            // Start a transaction
            DB::beginTransaction();
            
            // Enable query logging
            DB::connection()->enableQueryLog();
            
            // Include and run the migration file in a transaction
            require_once $migrationPath;
            
            // Get all defined classes
            $classes = get_declared_classes();
            
            // Find the migration class (should be the last anonymous class)
            $migrationClass = null;
            foreach (array_reverse($classes) as $className) {
                if (is_subclass_of($className, 'Illuminate\Database\Migrations\Migration')) {
                    $migrationClass = $className;
                    break;
                }
            }
            
            if (!$migrationClass) {
                DB::rollBack();
                DB::connection()->disableQueryLog();
                return "Error: Could not find migration class";
            }
            
            // Create instance
            $instance = new $migrationClass();
            
            // Run the migration method
            if (method_exists($instance, $direction)) {
                $instance->{$direction}();
            } else {
                DB::rollBack();
                DB::connection()->disableQueryLog();
                return "Error: Method $direction not found";
            }
            
            // Get the queries
            $queries = DB::getQueryLog();
            
            // Rollback the transaction (no changes actually made to database)
            DB::rollBack();
            
            // Disable query log
            DB::connection()->disableQueryLog();
            
            // Format queries
            $sql = '';
            foreach ($queries as $query) {
                $sql .= $this->formatQuery($query['query'], $query['bindings']) . ";\n";
            }
            
            return $sql ?: "No SQL queries detected for $direction operation";
            
        } catch (\Exception $e) {
            // Make sure to rollback on error
            DB::rollBack();
            DB::connection()->disableQueryLog();
            return "Error extracting SQL: " . $e->getMessage();
        }
    }
    
    /**
     * Extract migration class content from file
     */
    private function extractMigrationClass($migrationPath)
    {
        $content = file_get_contents($migrationPath);
        
        // Find the anonymous class declaration
        if (preg_match('/return\s+new\s+class\s+extends\s+Migration\s*\{.*?\}/s', $content, $matches)) {
            return $matches[0];
        }
        
        // Alternative pattern for older Laravel versions
        if (preg_match('/class\s+(\w+)\s+extends\s+Migration\s*\{.*?\}/s', $content, $matches)) {
            return $matches[0];
        }
        
        return null;
    }
    
    /**
     * Create a temporary migration class with a unique name
     */
    private function createTemporaryMigrationClass($classContent, $direction)
    {
        // Generate a unique class name
        $className = 'TempMigration_' . md5($classContent . $direction . time());
        
        // Create the temporary class file content
        $tempContent = "<?php\n\n";
        $tempContent .= "use Illuminate\Database\Migrations\Migration;\n";
        $tempContent .= "use Illuminate\Database\Schema\Blueprint;\n";
        $tempContent .= "use Illuminate\Support\Facades\Schema;\n\n";
        
        // Replace anonymous class with named class
        if (strpos($classContent, 'return new class extends Migration') === 0) {
            $tempContent .= "class {$className} extends Migration\n{\n";
            // Extract the class body (content between { and })
            preg_match('/\{(.*)\}/s', $classContent, $bodyMatches);
            if (isset($bodyMatches[1])) {
                $tempContent .= $bodyMatches[1] . "\n});\n}\n}\n";
            }
        } else {
            // For named classes, just replace the class name
            $tempContent = str_replace('class ', "class {$className} ", $classContent);
        }
        
        // Create temporary file
        $tempDir = storage_path('app/temp_migrations/');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0755, true);
        }
        
        $tempFile = $tempDir . $className . '.php';
        file_put_contents($tempFile, $tempContent);
        
        return [
            'file' => $tempFile,
            'className' => $className
        ];
    }
    
    /**
     * Execute raw SQL query
     */
    public function executeSql($sql)
    {
        try {
            // Split multiple queries
            $queries = $this->splitSqlQueries($sql);
            $results = [];
            
            foreach ($queries as $query) {
                $query = trim($query);
                if (empty($query)) continue;
                
                // Remove trailing semicolon if present
                if (substr($query, -1) === ';') {
                    $query = substr($query, 0, -1);
                }
                
                // Check query type
                $queryType = strtoupper(strtok($query, ' '));
                
                if (in_array($queryType, ['SELECT', 'SHOW', 'DESCRIBE'])) {
                    // For SELECT queries
                    $result = DB::select($query);
                    $results[] = [
                        'type' => 'select',
                        'query' => $query,
                        'result' => $result,
                        'row_count' => count($result)
                    ];
                } else {
                    // For INSERT, UPDATE, DELETE, CREATE, ALTER, DROP
                    $affected = DB::statement($query);
                    $results[] = [
                        'type' => strtolower($queryType),
                        'query' => $query,
                        'affected' => $affected,
                        'success' => true
                    ];
                }
            }
            
            return [
                'success' => true,
                'results' => $results,
                'message' => 'Query executed successfully'
            ];
            
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error executing SQL: ' . $e->getMessage(),
                'error' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Run a specific migration
     */
    public function runMigration($migrationName, $migrationPath)
    {
        try {
            // First extract SQL to show what will run
            $sql = $this->extractSqlFromMigration($migrationPath, 'up');
            
            if (strpos($sql, 'Error') === 0) {
                return [
                    'success' => false,
                    'message' => $sql
                ];
            }
            
            // Now actually execute the migration
            require_once $migrationPath;
            
            $classes = get_declared_classes();
            $migrationClass = null;
            foreach (array_reverse($classes) as $className) {
                if (is_subclass_of($className, 'Illuminate\Database\Migrations\Migration')) {
                    $migrationClass = $className;
                    break;
                }
            }
            
            if (!$migrationClass) {
                return [
                    'success' => false,
                    'message' => 'Could not find migration class'
                ];
            }
            
            $instance = new $migrationClass();
            
            // Execute the migration
            $instance->up();
            
            // Record migration in migrations table
            $batch = $this->getNextBatchNumber();
            DB::table('migrations')->insert([
                'migration' => $migrationName,
                'batch' => $batch
            ]);
            
            return [
                'success' => true,
                'message' => 'Migration executed successfully',
                'sql' => $sql
            ];
            
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Migration failed: ' . $e->getMessage()
            ];
        }
    }
    
    /**
     * Rollback a specific migration
     */
    public function rollbackMigration($migrationName, $migrationPath)
    {
        try {
            // Extract down SQL
            $sql = $this->extractSqlFromMigration($migrationPath, 'down');
            
            if (strpos($sql, 'Error') === 0) {
                return [
                    'success' => false,
                    'message' => $sql
                ];
            }
            
            // Execute down SQL
            $result = $this->executeSql($sql);
            
            if ($result['success']) {
                // Remove migration record
                DB::table('migrations')->where('migration', $migrationName)->delete();
            }
            
            return $result;
            
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Rollback failed: ' . $e->getMessage()
            ];
        }
    }
    
    /**
     * Get class name from migration file
     * For anonymous classes, we'll just return a placeholder
     */
    public function getClassNameFromFile($path)
    {
        $content = file_get_contents($path);
        
        // Check for anonymous class pattern (Laravel 9+)
        if (strpos($content, 'return new class extends Migration') !== false) {
            return 'AnonymousMigrationClass';
        }
        
        // Check for named class pattern (older Laravel)
        if (preg_match('/class\s+(\w+)\s+extends\s+Migration/', $content, $matches)) {
            return $matches[1];
        }
        
        return 'UnknownClass';
    }
    
    /**
     * Get batch from filename
     */
    public function getBatchFromFilename($filename)
    {
        // Extract timestamp from filename
        if (preg_match('/^\d{4}_\d{2}_\d{2}_\d{6}/', $filename, $matches)) {
            return $matches[0];
        }
        
        return '';
    }
    
    /**
     * Format query with bindings
     */
    private function formatQuery($query, $bindings)
    {
        $formatted = $query;
        foreach ($bindings as $binding) {
            $pos = strpos($formatted, '?');
            if ($pos !== false) {
                $value = is_string($binding) ? "'" . addslashes($binding) . "'" : $binding;
                $formatted = substr_replace($formatted, $value, $pos, 1);
            }
        }
        
        return $formatted;
    }
    
    /**
     * Split SQL queries
     */
    public function splitSqlQueries($sql)
    {
        // Remove comments
        $sql = preg_replace('/--.*$/m', '', $sql);
        $sql = preg_replace('/\/\*.*?\*\//s', '', $sql);
        
        // Split by semicolon, but not within quotes or parentheses
        $queries = [];
        $current = '';
        $inString = false;
        $stringChar = '';
        $parenDepth = 0;
        
        for ($i = 0; $i < strlen($sql); $i++) {
            $char = $sql[$i];
            $prevChar = $i > 0 ? $sql[$i-1] : '';
            $nextChar = $i < strlen($sql) - 1 ? $sql[$i+1] : '';
            
            // Handle string literals
            if (($char === "'" || $char === '"') && $prevChar !== '\\') {
                if (!$inString) {
                    $inString = true;
                    $stringChar = $char;
                } elseif ($stringChar === $char) {
                    $inString = false;
                }
            }
            
            // Handle parentheses
            if (!$inString) {
                if ($char === '(') {
                    $parenDepth++;
                } elseif ($char === ')') {
                    $parenDepth--;
                }
            }
            
            $current .= $char;
            
            // Split on semicolon if not in string and parentheses balanced
            if ($char === ';' && !$inString && $parenDepth === 0) {
                $queries[] = trim($current);
                $current = '';
            }
        }
        
        // Add any remaining query
        if (trim($current) !== '') {
            $queries[] = trim($current);
        }
        
        return $queries;
    }
    
    /**
     * Get next batch number
     */
    public function getNextBatchNumber()
    {
        if (!Schema::hasTable('migrations')) {
            return 1;
        }
        
        $maxBatch = DB::table('migrations')->max('batch');
        return ($maxBatch ?: 0) + 1;
    }

    public function loadMigrationInstance(string $migrationPath): Migration
    {
        $instance = require $migrationPath;

        if (!$instance instanceof Migration) {
            throw new \Exception('Migration file did not return a Migration instance');
        }

        return $instance;
    }
}