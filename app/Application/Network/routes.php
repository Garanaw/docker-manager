<?php

use Application\Network\Actions\Index;
use Illuminate\Routing\Router;

/** @var Router $router */
$router = app(Router::class);

$router->get('/networks', Index::class)
    ->name('networks.index')
    ->middleware('web');
