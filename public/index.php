<?php
//Start the session
session_start();

//Autoloader: allows us to refer to Slim and other dependencies.
require '../vendor/autoload.php';

//Require the 
require_once '../app/models/database.php';

//Require controllers
require_once '../app/controllers/autoload.php';

//Create instance of slim app (configured to show errors)
$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);

//Get DIC (Dependency injection container) 
$container= $app->getContainer();

//Adds flash messages
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

//Add views application to container. (slim/php-view)
$container['view']=function ($container) {
    $renderer = new \Slim\Views\PhpRenderer('../app/views');
    $renderer->addAttribute("flash", $container['flash']);
    return $renderer;
};

//Add access to data (mysql database)
$container['model'] = function($container){
    try{
        $model = new Database();
    }catch(PDOException $e){
        return null;
    }
    return $model;
};

//Require the routes 
require '../app/routes/routes.php';

//Run application
$app->run();

