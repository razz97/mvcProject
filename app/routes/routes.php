<?php
$app->get('/', '\App\Controllers\HomeController:getHomepage');

$app->get('/authentification', '\App\Controllers\HomeController:authentificate');

$app->post('/register', '\App\Controllers\HomeController:register');

$app->get('/user', '\App\Controllers\UserController:getUserpage');

$app->post('/user/newMsg', '\App\Controllers\UserController:postMsg');

$app->get('/user/logOut', '\App\Controllers\UserController:logout');


