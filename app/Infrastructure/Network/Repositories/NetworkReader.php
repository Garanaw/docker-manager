<?php

declare(strict_types=1);

namespace Infrastructure\Network\Repositories;

use Infrastructure\Network\Models\Network;
use Illuminate\Database\Eloquent\Collection;

class NetworkReader
{
    public function __construct(private Network $model)
    {
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }
}
