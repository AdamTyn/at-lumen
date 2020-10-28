<?php

require_once __DIR__ . '/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$entrance = __DIR__ . '/core.php';

if (file_exists($entrance)) {
    include_once $entrance;
    $app = new Core(dirname(__DIR__));
} else {
    $app = new Laravel\Lumen\Application(
        dirname(__DIR__)
    );
}

$app->withFacades();

// $app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Config Files
|--------------------------------------------------------------------------
|
| Now we will register the "app" configuration file. If the file exists in
| your configuration driectory it will be loaded; otherwise, we'll load
| the default version. You may register other files below as needed.
|
*/

// 注册状态码配置文件
$app->configure('codes');
// 注册阀门开关配置文件
$app->configure('switcher');

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

$app->middleware([
    App\Middleware\CheckForMaintenanceMode::class // 检查维护模式中间件
]);

$app->routeMiddleware([
    'auth' => App\Middleware\Authenticate::class,
    'form' => App\Middleware\Form::class,
    'logger' => App\Middleware\Logger::class,
    'switcher' => App\Middleware\Switcher::class,
    'throttle' => App\Middleware\Throttle::class // 限流中间件
]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);
$app->register(App\Providers\ValidatorServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->router->group([
    'namespace' => '',
    'middleware' => [
        'logger',
        'throttle:60,1' // 限制1分钟60次
    ]
], function ($router) {
    require_once __DIR__ . '/../routes/index.php';
});

return $app;
