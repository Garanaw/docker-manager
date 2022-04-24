<?php

declare(strict_types=1);

namespace App\Domain\Shared\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

abstract class BladeServiceProvider extends ServiceProvider
{
    private const SHARED_NAMESPACE = 'Infrastructure\\Shared\\Components';
    private const SHARED_PREFIX = 'shared';

    protected BladeCompiler $bladeCompiler;

    public function boot(): void
    {
        $this->bladeCompiler = $this->app->make(BladeCompiler::class);
        $this->bladeCompiler->componentNamespace(self::SHARED_NAMESPACE, self::SHARED_PREFIX);

        $this->registerDomainComponents();
    }

    abstract protected function registerDomainComponents(): void;
}
