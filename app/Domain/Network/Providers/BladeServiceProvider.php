<?php

declare(strict_types=1);

namespace App\Domain\Network\Providers;

use App\Domain\Shared\Providers\BladeServiceProvider as ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    private const DOMAIN_NAMESPACE = 'UserInterface\\Network\\Components';
    private const DOMAIN_PREFIX = 'network';

    protected function registerDomainComponents(): void
    {
        $this->bladeCompiler->componentNamespace(self::DOMAIN_NAMESPACE, self::DOMAIN_PREFIX);
    }
}
