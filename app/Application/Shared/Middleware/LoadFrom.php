<?php

declare(strict_types=1);

namespace App\Application\Shared\Middleware;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class LoadFrom
{
    public function __construct(private Application $app)
    {
    }

    public function handle(Request $request, \Closure $next)
    {
        $this->getProviders()->each(
            fn (string $provider) => $this->app->register($provider)
        );

        return $next($request);
    }

    private function getProviders(): Collection
    {
        return collect($this->app['config']->get('domain.shared.providers', []));
    }
}

