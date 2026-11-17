<?php
// Local development router for PHP CLI server (emulates .htaccess & prevents soft 404s)
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $uri;

// 1. Canonical redirect: /index.php -> /
if ($uri === '/index.php') {
    header('Location: /', true, 301);
    exit;
}
if ($uri === '/berita/index.php') {
    header('Location: /berita/', true, 301);
    exit;
}

// 2. Static file check
if ($uri !== '/' && file_exists($file) && !is_dir($file)) {
    return false; // serve directly
}

// 2. Article Pretty URLs: /berita/slug
if (preg_match('#^/berita/([a-zA-Z0-9_-]+)/?$#', $uri, $matches)) {
    $_GET['slug'] = $matches[1];
    require __DIR__ . '/berita/detail.php';
    return true;
}

// 3. Directory index routing
if (is_dir($file) && file_exists($file . '/index.php')) {
    require $file . '/index.php';
    return true;
}

// 4. Canonical redirect: /index.php -> /
if ($uri === '/index.php') {
    header('Location: /', true, 301);
    exit;
}
if ($uri === '/berita/index.php') {
    header('Location: /berita/', true, 301);
    exit;
}
if ($uri === '/') {
    require __DIR__ . '/index.php';
    return true;
}

// 5. Existing PHP script routing
if (file_exists($file . '.php')) {
    require $file . '.php';
    return true;
}

// 6. Hard 404 for non-existent routes
http_response_code(404);
if (file_exists(__DIR__ . '/404.php')) {
    require __DIR__ . '/404.php';
} else {
    echo '<!DOCTYPE html><html><head><title>404 Not Found</title></head><body><h1>404 Not Found</h1></body></html>';
}
return true;
