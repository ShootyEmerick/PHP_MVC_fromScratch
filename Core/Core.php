<?php

namespace Core;

/**
 * Main Class
 * Called at all the way
 * Transform url for get routes information
 * Call to Controller & Action associate
 */
class Core
{
    /**
     * @var $getFromUrl
     * Contain the url to send to the Router::get()
     */
    private $getFromUrl;

    /**
     * Initialize all the routes used by the framework (include_once)
     * Parse the url for get information of the route
     * Instance of the Controller œ Action associate
     * Show error message if wrong method in the route
     */
    public function run()
    {
        echo __CLASS__ . " [OK]" . PHP_EOL;
        include_once "routes.php";

        $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $parse = parse_url($url);
        $parsePath = $parse['path'];
        $myBaseUri = BASE_URI . '/';
        $baseUriCount = strlen($myBaseUri);
        $parseUrl = substr($parsePath, $baseUriCount - 1);
        $this->getFromUrl = $parseUrl;

        $route = Router::get($this->getFromUrl);
        $controller = ucfirst($route['controller']) . 'Controller';
        $targetController = new $controller;
        $action = $route['action'] . 'Action';

        if (method_exists($targetController, $action)) {
            $targetController->$action();
        } else {
            echo "<h3>Check the method associate to the route because she is not found</h3>";
        }
    }
}
