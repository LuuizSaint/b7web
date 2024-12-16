<?php

use app\routes\Route;

function routeExecutor()
{

    try{

        $routeObj = new Route;
        $routesArray = require dirname(__DIR__).'/routes/routes.php';
        $routeObj->executor($routesArray);

        // return $routeObj;

    }catch(Throwable $th){
        var_dump($th->getMessage());
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