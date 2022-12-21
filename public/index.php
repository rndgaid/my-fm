<?php

error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use My\Fm\Vendor\Core\Router;

$query = rtrim($_SERVER['QUERY_STRING'], '/');
$request = rtrim($_SERVER['REQUEST_URI'], '/');

print '<b>QUERY_STRING:</b> ' . $query . '<br>';
print '<b>REQUEST_URI:</b> ' . $request . '<br>';

Router::add('posts/add', ['controller' => 'posts', 'action' => 'add']);
Router::add('posts/', ['controller' => 'posts', 'action' => 'index']);
Router::add('', ['controller' => 'Main', 'action' => 'index']);

print '<pre>' . print_r(Router::getRoutes(), true) . '</pre>';

if (Router::matchRoute($query)) {
    var_dump(Router::getRoute());
} else {
    echo '404';
}
