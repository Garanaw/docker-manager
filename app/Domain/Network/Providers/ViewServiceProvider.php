<?php

declare(strict_types=1);

namespace App\Domain\Network\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    private const DOMAIN = 'network';

    public function boot(): void
    {
        $this->loadViewsFrom(
            app_path('UserInterface/Network/Resources/views'),
            self::DOMAIN
        );
    }
}
