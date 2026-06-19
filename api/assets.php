<?php
$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);
$file = $queries['file'];

$path = __DIR__ . '/../' . $file;

if (!file_exists($path)) {
    http_response_code(404);
    echo "File not found";
    exit;
}

$ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
$mimeTypes = [
    'css' => 'text/css',
    'js' => 'application/javascript',
    'png' => 'image/png',
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'gif' => 'image/gif',
    'svg' => 'image/svg+xml',
    'ico' => 'image/x-icon',
    'woff' => 'font/woff',
    'woff2' => 'font/woff2',
    'ttf' => 'font/ttf',
];

if (isset($mimeTypes[$ext])) {
    header('Content-Type: ' . $mimeTypes[$ext]);
}

readfile($path);