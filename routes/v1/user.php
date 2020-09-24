<?php

isset($router) ?: true;

if ($router instanceof \Laravel\Lumen\Routing\Router) {
    $router->group(['prefix' => 'user', 'middleware' => ['switcher']], function () use ($router) {
        $router->get('list', ['uses' => 'UserController@index', 'as' => 'user-list']);
        $router->get('info', ['uses' => 'UserController@show', 'as' => 'user-info']);
        $router->post('create', ['uses' => 'UserController@store', 'as' => 'user-edit']);
    });
}
