<?php

declare(strict_types=1);

namespace App\Domain\Network\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
    private Router $router;

    public function __construct($app)
    {
        parent::__construct($app);
        $this->router = $app['router'];
    }

    public function boot(): void
    {
        $this->router
            ->middleware('web')
            ->prefix('network')
            ->group(base_path('app/Application/Network/routes.php'));
    }
}
