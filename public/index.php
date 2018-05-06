<?php

//Autoloader: allows us to refer to Slim and other dependencies.
require '../vendor/autoload.php';

//Create instance of slim app (configured to show errors)
$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);

//Get DIC (Dependency injection container) 
$container= $app->getContainer();

//Adds flash messages
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

//Add views application to container. (slim/php-view)
$container["view"]=function ($container) {
    return new \Slim\Views\PhpRenderer('../app/views',$container->flash);
};
//Adds home controller
$container["HomeController"] = function ($container) {
	return new \App\Controllers\HomeController($container);
};
//Adds user controller
$container["UserController"] = function ($container) {
	return new \App\Controllers\UserController($container);
};

session_start();

//Require the routes 
require '../app/routes/routes.php';

//Run application
$app->run();

