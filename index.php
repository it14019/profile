<?php

require_once __DIR__ . '/vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $router) {
    $router->addRoute('GET', '/', 'ApplicationController@show');
    $router->addRoute('POST', '/', 'ApplicationController@store');
    $router->addRoute('POST', '/profile', 'ApplicationController@showProfile');
    $router->addRoute('GET', '/profile/edit', 'ApplicationController@showEditProfile');
    $router->addRoute('POST', '/profile/update', 'ApplicationController@update');
    $router->addRoute('POST', '/profile/logout', 'ApplicationController@logout');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controller, $method] = explode('@', $handler);

        $controllerPath = 'App\Controllers\\' . $controller;
        echo (new $controllerPath)->{$method}($vars);
        // ... call $handler with $vars
        break;
}
