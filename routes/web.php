<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api', 'middleware'=> 'auth'], function () use ($router){
    $router->group(['prefix' => 'usuario'], function () use ($router){
        $router->get('', 'UsuariosController@index');
        $router->post('', 'UsuariosController@store');
        $router->get('{id}', 'UsuariosController@show');
        $router->put('{id}', 'UsuariosController@update');
        $router->delete('{id}', 'UsuariosController@destroy');
        $router->get('{id}/{status}', 'UsuariosController@showStatusTarefa');
    });
    
    $router->group(['prefix' => 'tarefa'], function () use ($router) {
        $router->get('{id}', 'TarefasController@show');
        $router->get('{id_usuario}/tarefas', 'TarefasController@index');
        $router->post('{id}','TarefasController@store');
        $router->put('{id}', 'TarefasController@update');
        $router->delete('{id}', 'TarefasController@destroy');
    });
});

$router->post('/api/login', 'TokenController@gerarToken');