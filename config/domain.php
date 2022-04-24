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
            App\Domain\Network\Providers\BladeServiceProvider::class,
        ],
    ],
];
