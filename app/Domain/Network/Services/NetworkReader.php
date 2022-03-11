<?php

declare(strict_types=1);

namespace App\Domain\Network\Services;

use App\Infrastructure\Network\Repositories\NetworkReader as Reader;
use Illuminate\Database\Eloquent\Collection;

class NetworkReader
{
    public function __construct(private Reader $networksReader)
    {
    }

    public function getAll(): Collection
    {
        return $this->networksReader->getAll();
    }
}
