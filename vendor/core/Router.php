<?php

namespace My\Fm\Vendor\Core;

use My\Fm\App\Controllers\Posts;
use My\Fm\App\Controllers\Main;

class Router
{
    /**
     * таблица маршрутов
     * @var array<string, array<string>>
     */
    private static array $routes = [];
    /**
     * текущий маршрут
     * @var array<string>
     */
    private static array $route = [];
    /**
     * добавляет маршрут в таблицу маршрутов
     * @param array<string> $route
     */
    public static function add(string $regexp, array $route = []): void
    {
        self::$routes[$regexp] = $route;
    }

    /**
     * возвращает таблицу маршрутов
     * @return array<string, array<string>>
     */
    public static function getRoutes(): array
    {
        return self::$routes;
    }

    /**
     * возвращает текущий маршрут (controller, action, [params])
     * @return array<string>
     */
    public static function getRoute(): array
    {
        return self::$route;
    }

    /**
     * ищет URL в таблице маршрутов
     */
    public static function matchRoute(string $url): bool
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    /**
     * перенаправляет url по корректному маршруту
     */
    public static function dispatch(string $url): void
    {
        if (self::matchRoute($url)) {
            $controller = 'My\\Fm\\App\\Controllers\\' . self::$route['controller'];
            if (class_exists($controller)) {
                print "$controller";
            } else {
                echo "Controller <b>$controller</b> not found";
            }
        } else {
            http_response_code(404);
            include __DIR__ . '/../../public/404.html';
        }
    }
}
