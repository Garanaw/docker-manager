<?php

declare(strict_types=1);

namespace Domain\Network\Providers;

use App\Domain\Shared\Providers\ViewServiceProvider as ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    private const DOMAIN = 'network';

    public function boot(): void
    {
        parent::boot();

        $this->loadViewsFrom(
            app_path('UserInterface/Network/Resources/views'),
            self::DOMAIN
        );
    }
}
