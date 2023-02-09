<?php
namespace Tsel\Blog\core;

use Tsel\Blog\controllers\MainController;

class Route
{
    static function start()
    {
        $controllerName = 'Main';
        $actionName = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[1]))
        {
            $controllerName = $routes[1];
        }

        if (!empty($routes[2]))
        {
            $actionName = $routes[2];
        }

        $controllerName = ucfirst($controllerName) . 'Controller';

        $controller = match($controllerName)
        {
            'MainController' => MainController::class,
            default => 'not found'
        };

        if (!empty($_COOKIE['PHPSESSID'])) {
            $controller = match($controllerName)
            {
                default => 'not found'
            };
        }

        if($controller !== 'not found')
        {
            $controller = new $controller;
        } else {
            Route::ErrorPage404();
        }

        $action = $actionName;

        if(method_exists($controller, $action))
        {
            $controller->$action();
        } else {
            Route::ErrorPage404();
        }
    }

    static function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}