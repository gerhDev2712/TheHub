<?php

ini_set('display_errors', 1);
ini_set('display_starup_error', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;


//Eloquent
$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => '',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();


//Diactoros
$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

//ROUTER
$routerContainer = new RouterContainer();  
$map = $routerContainer->getMap();

$map->get('index', '/DESARROLLO/theHUB/', [
    'controller' => 'App\Controllers\IndexController',
    'action' => 'indexAction'
]); 


$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);

if(!$route){
    echo('No route');
}else {

    $handlerData = $route->handler;
    $controllerName = $handlerData['controller'];
    $actionName = $handlerData['action'];

    $controller = new $controllerName;
    $controller->$actionName($request);

}