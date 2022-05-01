<?php

return [
    'available_domains' => [
        'network',
        'shared',
        'user',
    ],
    'network' => [
        'providers' => [
            Domain\Network\Providers\ViewServiceProvider::class,
            Domain\Network\Providers\BladeServiceProvider::class,
        ],
    ],
    'shared' => [
        'providers' => [
            Domain\Shared\Providers\ViewServiceProvider::class,
            Domain\Shared\Providers\BladeServiceProvider::class,
        ],
    ],
];
