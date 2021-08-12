<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api', 'middleware'=> 'auth'], function () use ($router){
    $router->post('/usuario', 'UsuariosController@store');
    $router->get('/usuario', 'UsuariosController@index');
});

$router->post('/api/login', 'TokenController@gerarToken');