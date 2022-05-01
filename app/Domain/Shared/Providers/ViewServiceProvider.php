<?php

declare(strict_types=1);

namespace Domain\Shared\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(
            app_path('UserInterface/Shared/Resources/views'),
            'shared'
        );
    }
}
