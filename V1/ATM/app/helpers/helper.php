<?php

use app\routes\Route;
use app\views\View;

function routeExecutor()
{

    try{

        $routeObj = new Route;
        $routesArray = require dirname(__DIR__).'/routes/routes.php';
        $routeObj->executor($routesArray);

    }catch(Throwable $th){
        var_dump($th->getMessage());
    }

}

function viewExecutor(string $view, array $data = [])
{
    try{
        $viewObj = new View;
        echo $viewObj->executor($view, $data);
    }
    catch(Throwable $th){
        dd($th->getMessage());
    }

}

function dd($dump)
{
    echo '<pre>';
    print_r($dump);
    echo '</pre>';

    die();
}

function redirect(string $to)
{
    return header('Location: '.$to);
}