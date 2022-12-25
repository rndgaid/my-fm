<?php

error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use My\Fm\App\Controllers\Main;
use My\Fm\App\Controllers\Posts;
use My\Fm\Vendor\Core\Router;

$request = rtrim(str_replace('/my-fm/', '', $_SERVER['REQUEST_URI']), '/');

Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

echo '<pre>' . print_r(Router::getRoutes(), true) . '</pre>';

Router::dispatch($request);

if (class_exists("My\\Fm\\App\\Controllers\\Posts")) {
    //print 'Ok';
}

