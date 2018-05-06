<?php
$app->get('/', 'HomeController:getHomepage');

$app->get('/authentification', 'HomeController:authentificate');

$app->post('/register', 'HomeController:register');

$app->get('/user', 'UserController:getUserpage');

$app->post('/user/newMsg', 'UserController:postMsg');

$app->get('/user/logOut', 'UserController:logout');


