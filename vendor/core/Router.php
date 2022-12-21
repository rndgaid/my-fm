<?php

namespace My\Fm\Vendor\Core;

class Router
{
    /**
     * @var array<string, array<string>>
     */
    protected static array $routes = [];

    /**
     * @var array<string>
     */
    protected static array $route = [];

    /**
     * @param string $regexp
     * @param array<string> $route
     * @return void
     */
    public static function add(string $regexp, array $route = []): void
    {
        self::$routes[$regexp] = $route;
    }

    /**
     * @return array<string, array<string>>
     */
    public static function getRoutes(): array
    {
        return self::$routes;
    }

    /**
     * @return array<string>
     */
    public static function getRoute(): array
    {
        return self::$route;
    }

    /**
     * @param string $url
     * @return bool
     */
    public static function matchRoute(string $url): bool
    {
        foreach (self::$routes as $pattern => $route) {
            if ($url == $pattern) {
                self::$route = $route;
                return true;
            }
        }
        return false;
    }
//    public static function dispatch(string $url): void
//    {
//        if (self::matchRoute($url)) {
//            echo "Ok";
//        } else {
//            http_response_code(404);
//            require_once __DIR__ . '/../../public/404.html';
//        }
//    }
//
//    protected function upperCamelCase(string $name): string
//    {
//        $name = ucwords(str_replace('-', ' ', $name));
//        return str_replace(' ', '', $name);
//    }
}
