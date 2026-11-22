<?php
// Local routing for: php -S localhost:8080 includes/router.php
$root = dirname(__DIR__);
$path = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/');
$asset = realpath($root . $path);
if (strpos($path, '/assets/') === 0 && $asset !== false && strpos($asset, $root . '/assets/') === 0 && is_file($asset)) {
    return false;
}
if (in_array($path, ['/robots.txt', '/sitemap.xml'], true)) {
    return false;
}
$routes = [
    '/' => 'index.php',
    '/index' => 'index.php',
    '/despre-noi' => 'despre-noi.php',
    '/servicii' => 'servicii.php',
    '/serviciu' => 'serviciu.php',
    '/proiecte' => 'proiecte.php',
    '/domenii' => 'domenii.php',
    '/contact' => 'contact.php',
    '/cariere' => 'cariere.php',
    '/confidentialitate' => 'confidentialitate.php',
    '/404' => '404.php',
];
$file = isset($routes[$path]) ? $routes[$path] : '404.php';
$_SERVER['SCRIPT_NAME'] = '/' . $file;
$_SERVER['SCRIPT_FILENAME'] = $root . '/' . $file;
require $root . '/' . $file;
