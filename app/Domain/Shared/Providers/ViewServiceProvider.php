<?php

declare(strict_types=1);

namespace App\Domain\Shared\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(
            base_path('UserInterface/Shared/Resources/views'),
            'shared'
        );
    }
}
