<?php

isset($router) ?: true;

if ($router instanceof \Laravel\Lumen\Routing\Router) {
    foreach (glob(__DIR__ . '/v1/*.php') as $routerFile) {
        $router->group(['prefix' => 'v1', 'namespace' => '\\App\\V1\\Controllers'], function () use ($router, $routerFile) {
            require_once $routerFile;
        });
    }
}
