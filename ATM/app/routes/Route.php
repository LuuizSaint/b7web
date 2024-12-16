<?php

namespace app\routes;

use Exception;

class Route
{
    private string $uri;
    private string $method;

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function executor(array $routes)
    {
        $this->routeFound($routes);

        [$controller, $action] = explode('@', $routes[$this->method][$this->uri]);

        $controllerNamespace = "app\\controllers\\{$controller}";


        $this->controllerFound($controllerNamespace, $controller, $action); 

        $controllerInstance = new $controllerNamespace;

        $controllerInstance->$action();
    }

    private function routeFound(array $routes)
    {
        if(!isset($routes[$this->method])){
            throw new Exception("Método {$this->method} inexistente!");
        }

        if(!isset($routes[$this->method][$this->uri])){
            throw new Exception("URI {$this->uri} inexistente!");
        }
    }

    private function controllerFound(string $controllerNamespace, string $controller, string $action)
    {
        if(!class_exists($controllerNamespace)){
            throw new Exception("Controller {$controller} inexistente!");
        }


        if(!method_exists($controllerNamespace, $action)){
            throw new Exception("Action {$action} inexistente!");
        }
    }
}