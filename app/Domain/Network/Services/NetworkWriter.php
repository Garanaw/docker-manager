<?php

declare(strict_types=1);

namespace App\Domain\Network\Services;

use App\Domain\Network\Dto\CreateNetworkDto;
use App\Infrastructure\Network\Models\Network;
use App\Infrastructure\Network\Repositories\NetworkWriter as Writer;

class NetworkWriter
{
    public function __construct(private Writer $writer)
    {
    }

    public function create(CreateNetworkDto $dto): Network
    {
        return $this->writer->create($dto);
    }
}
