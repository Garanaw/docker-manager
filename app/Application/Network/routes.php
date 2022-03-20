<?php

use Application\Network\Middleware\LoadFrom;
use Application\Network\Actions\Index;
use Application\Network\Actions\Show;
use Application\Network\Actions\Store;
use Illuminate\Routing\Router;

/** @var Router $router */
$router = app(Router::class);
$middleware = [
    LoadFrom::class,
    'web'
];

$router->group(['middleware' => $middleware], function (Router $router) {
    $router->get('/', Index::class)
        ->name('networks.index');

    $router->view('/create', 'network::create')
        ->name('networks.create');

    $router->post('/store', Store::class)
        ->name('networks.store');

    $router->get('/{network}', Show::class)
        ->name('networks.show');

//    $router->get('/{network}/edit', Index::class)
//        ->name('networks.edit');
});
