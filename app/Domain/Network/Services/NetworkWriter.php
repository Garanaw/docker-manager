<?php

declare(strict_types=1);

namespace Domain\Network\Services;

use Domain\Network\Dto\CreateNetworkDto;
use Infrastructure\Network\Models\Network;
use Infrastructure\Network\Repositories\NetworkWriter as Writer;

class NetworkWriter
{
    public function __construct(private readonly Writer $writer)
    {
    }

    public function create(CreateNetworkDto $dto): Network
    {
        return $this->writer->create($dto);
    }
}
