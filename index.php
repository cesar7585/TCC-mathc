<?php

require_once __DIR__ . '/routes/Router.php';

$requestUri = $_SERVER['REQUEST_URI'];

$router = new Router;
$router->run($requestUri);