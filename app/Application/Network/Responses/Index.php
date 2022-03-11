<?php

declare(strict_types=1);

namespace App\Application\Network\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Factory;
use Illuminate\View\View;

class Index implements Responsable
{
    private Collection $networks;

    public function __construct(private Factory $view)
    {
    }

    public function setNetworks(Collection $networks): self
    {
        $this->networks = $networks;

        return $this;
    }

    public function toResponse($request): View
    {
        return $this->view->make('network.index', [
            'networks' => $this->networks,
        ]);
    }
}
