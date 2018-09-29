<?php

namespace Core;

/**
 * Class Router
 * Can initialize new routes
 * Get information of routes initialized before
 */
class Router
{
    /**
     * @var array associative of all routes
     * initialized by connect()
     */
    private static $routes = [];

    /**
     * @param $url string
     * @param $route array
     */
    public static function connect($url, $route)
    {
        echo __CLASS__ . " [OK] " . " : One new route initialize successfully<br>";

        self::$routes[$url] = $route;
    }

    /**
     * @param $url string
     * @return array contain routes information
     * Get all the routes from $routes
     * Get all params from $params
     */
    public static function get($url)
    {
        $long = strlen($url);
        if ($url[$long-1] !== "/") {
            $url[$long] = "/";
        }
        if (isset(self::$routes[$url])) {
            return self::$routes[$url];
        } else {
            return ['controller' => 'error', 'action' => 'error'];
        }
    }
}
