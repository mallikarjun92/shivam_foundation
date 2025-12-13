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
        'avif' => 'image/avif',
    ];
    
    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    $mime = $mimeTypes[$extension] ?? mime_content_type($filePath);
    
    header('Content-Type: ' . $mime);
    readfile($filePath);
    exit;
}

http_response_code(404);
echo 'File not found';