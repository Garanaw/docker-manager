<?php

namespace App\Providers;

use Infrastructure\Shared\Models\Teams\Team;
use App\Policies\TeamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /** @var array<class-string, class-string> */
    protected $policies = [
        Team::class => TeamPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
