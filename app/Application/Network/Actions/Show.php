<?php

declare(strict_types=1);

namespace Application\Network\Actions;

use Infrastructure\Network\Models\Network;
use Illuminate\Contracts\View\View;
use Illuminate\View\Factory;

class Show
{
    public function __invoke(Network $network, Factory $view): View
    {
        return $view->make('network::show', [
            'network' => $network->loadMissing('settings', 'driver'),
        ]);
    }
}
