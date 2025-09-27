<?php
// app/Http/Controllers/Admin/MaintenanceController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MaintenanceController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('role:admin');
    //     $this->middleware('throttle:3,1')->only(['fixStorage', 'fixSymlink']); // Limit to 3 attempts per minute
    // }

    public function index()
    {
        return view('admin.maintenance.index');
    }

    public function fixStorage(Request $request)
    {
        $directories = [
            'app/public/hero',
            'app/public/hero/videos',
            'app/public/events',
            'app/public/galleries',
            'app/public/volunteers',
            'app/public/blogs',
        ];

        $results = [];
        
        foreach ($directories as $directory) {
            $path = storage_path($directory);
            
            if (!File::exists($path)) {
                if (File::makeDirectory($path, 0755, true)) {
                    $results[] = "Created directory: {$directory}";
                } else {
                    $results[] = "Failed to create directory: {$directory}";
                }
            } else {
                $results[] = "Directory already exists: {$directory}";
            }
            
            // Set permissions if on Unix-like system
            if (function_exists('chmod')) {
                chmod($path, 0755);
            }
        }

        return back()->with('success', 'Storage directories fixed successfully!')
                    ->with('results', $results);
    }

    // public function fixSymlink(Request $request)
    // {
    //     $publicStoragePath = public_path('storage');
    //     $appStoragePath = storage_path('app/public');
        
    //     $results = [];
        
    //     // Remove existing symlink if it exists
    //     if (File::exists($publicStoragePath) || is_link($publicStoragePath)) {
    //         if (is_link($publicStoragePath)) {
    //             if (unlink($publicStoragePath)) {
    //                 $results[] = "Removed existing symlink";
    //             } else {
    //                 $results[] = "Failed to remove existing symlink";
    //             }
    //         } else {
    //             $results[] = "Public storage path exists but is not a symlink";
    //         }
    //     }
        
    //     // Create new symlink
    //     if (function_exists('symlink')) {
    //         if (symlink($appStoragePath, $publicStoragePath)) {
    //             $results[] = "Symlink created successfully";
    //         } else {
    //             $results[] = "Failed to create symlink using PHP symlink() function";
                
    //             // Fallback: try to create the directory structure manually
    //             $this->createFallbackStructure($results);
    //         }
    //     } else {
    //         $results[] = "symlink() function is disabled on this server";
            
    //         // Fallback: try to create the directory structure manually
    //         $this->createFallbackStructure($results);
    //     }
        
    //     return back()->with('success', 'Symlink operation completed!')
    //                 ->with('results', $results);
    // }
    
    // private function createFallbackStructure(&$results)
    // {
    //     $results[] = "Attempting fallback method...";
        
    //     // Create the public/storage directory if it doesn't exist
    //     $publicStoragePath = public_path('storage');
    //     if (!File::exists($publicStoragePath)) {
    //         File::makeDirectory($publicStoragePath, 0755, true);
    //         $results[] = "Created public/storage directory";
    //     }
        
    //     // Copy default images to public storage
    //     $defaultImages = [
    //         'default-event.jpg',
    //         'default-gallery.jpg',
    //         'default-hero.jpg',
    //         'default-volunteer.jpg',
    //         'default-blog.jpg',
    //     ];
        
    //     foreach ($defaultImages as $image) {
    //         $source = public_path("images/{$image}");
    //         $destination = public_path("storage/{$image}");
            
    //         if (File::exists($source) && !File::exists($destination)) {
    //             File::copy($source, $destination);
    //             $results[] = "Copied {$image} to public storage";
    //         }
    //     }
        
    //     $results[] = "Fallback method completed. Note: Uploaded files will be stored in storage/app/public but may not be accessible through web until symlink is properly configured.";
    // }

    public function fixSymlink(Request $request)
    {
        $publicStoragePath = public_path('storage');
        $appStoragePath = storage_path('app/public');
        
        $results = [];
        
        // Remove existing symlink or directory if it exists
        if (File::exists($publicStoragePath)) {
            if (is_link($publicStoragePath)) {
                if (unlink($publicStoragePath)) {
                    $results[] = "Removed existing symlink";
                } else {
                    $results[] = "Failed to remove existing symlink";
                    return back()->with('error', 'Cannot remove existing symlink. Permission denied.')
                                ->with('results', $results);
                }
            } else {
                // It's a directory, not a symlink
                $results[] = "Public storage path exists but is not a symlink";
            }
        }
        
        // Try to create symlink (might fail on shared hosting)
        $symlinkSuccess = false;
        if (function_exists('symlink')) {
            try {
                if (symlink($appStoragePath, $publicStoragePath)) {
                    $results[] = "Symlink created successfully using PHP symlink()";
                    $symlinkSuccess = true;
                } else {
                    $results[] = "Failed to create symlink using PHP symlink() function";
                }
            } catch (\Exception $e) {
                $results[] = "Symlink error: " . $e->getMessage();
            }
        } else {
            $results[] = "symlink() function is disabled on this server";
        }
        
        // If symlink failed, use the fallback method
        if (!$symlinkSuccess) {
            $results = array_merge($results, $this->createFallbackStructure());
        }
        
        return back()->with($symlinkSuccess ? 'success' : 'info', 
                    $symlinkSuccess ? 'Symlink created successfully!' : 'Using fallback method (symlink not available)')
                    ->with('results', $results);
    }
    
    private function createFallbackStructure()
    {
        $results = [];
        $publicStoragePath = public_path('storage');
        $appStoragePath = storage_path('app/public');
        
        $results[] = "Using fallback method: Creating directory structure";
        
        // Create the public/storage directory if it doesn't exist
        if (!File::exists($publicStoragePath)) {
            if (File::makeDirectory($publicStoragePath, 0755, true)) {
                $results[] = "Created public/storage directory";
            } else {
                $results[] = "Failed to create public/storage directory";
                return $results;
            }
        }
        
        // Create .htaccess to redirect requests to storage
        $htaccessContent = <<<'HTACCESS'
<IfModule mod_rewrite.c>
    RewriteEngine On
    # Redirect requests to storage if file exists there
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ /storage/app/public/$1 [L]
</IfModule>
HTACCESS;
        
        $htaccessPath = public_path('.htaccess');
        if (File::exists($htaccessPath)) {
            // Backup existing .htaccess
            $backupPath = public_path('.htaccess.backup');
            File::copy($htaccessPath, $backupPath);
            $results[] = "Backed up existing .htaccess file";
            
            // Append our rules to existing .htaccess
            $existingContent = File::get($htaccessPath);
            if (strpos($existingContent, 'RewriteRule ^(.*)$ /storage/app/public/$1') === false) {
                File::put($htaccessPath, $existingContent . "\n\n" . $htaccessContent);
                $results[] = "Added storage rules to existing .htaccess";
            } else {
                $results[] = "Storage rules already exist in .htaccess";
            }
        } else {
            // Create new .htaccess
            File::put($htaccessPath, $htaccessContent);
            $results[] = "Created .htaccess file with storage rules";
        }
        
        // Create a router file to handle storage requests
        $this->createStorageRouter($results);
        
        $results[] = "Fallback method completed. Files will be accessible through direct URLs.";
        $results[] = "Note: You may need to configure your server to use the custom router if .htaccess is not supported.";
        
        return $results;
    }
    
    private function createStorageRouter(&$results)
    {
        $routerContent = <<<'PHP'
<?php
// public/storage.php - Router for storage files
$path = $_SERVER['REQUEST_URI'];
$filePath = __DIR__ . '/../storage/app/public' . $path;

if (file_exists($filePath) && is_file($filePath)) {
    $mimeTypes = [
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'webp' => 'image/webp',
        'pdf' => 'application/pdf',
        'txt' => 'text/plain',
    ];
    
    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    $mime = $mimeTypes[$extension] ?? mime_content_type($filePath);
    
    header('Content-Type: ' . $mime);
    readfile($filePath);
    exit;
}

http_response_code(404);
echo 'File not found';
PHP;

        $routerPath = public_path('storage.php');
        File::put($routerPath, $routerContent);
        $results[] = "Created storage router at /storage.php";
    }

    public function checkStatus()
    {
        $status = [];
        
        // Check storage directories
        $directories = [
            'app/public/hero' => storage_path('app/public/hero'),
            'app/public/events' => storage_path('app/public/events'),
            'app/public/galleries' => storage_path('app/public/galleries'),
            'app/public/volunteers' => storage_path('app/public/volunteers'),
            'app/public/blogs' => storage_path('app/public/blogs'),
        ];
        
        foreach ($directories as $name => $path) {
            $status[$name] = [
                'exists' => File::exists($path),
                'writable' => File::exists($path) ? is_writable($path) : false,
            ];
        }
        
        // Check symlink
        $publicStoragePath = public_path('storage');
        $appStoragePath = storage_path('app/public');
        
        $status['symlink'] = [
            'exists' => File::exists($publicStoragePath),
            'is_link' => is_link($publicStoragePath),
            'points_to' => is_link($publicStoragePath) ? readlink($publicStoragePath) : null,
            'correct' => is_link($publicStoragePath) && (readlink($publicStoragePath) == $appStoragePath),
        ];
        
        return response()->json($status);
    }
}