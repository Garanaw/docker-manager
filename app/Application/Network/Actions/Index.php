<?php

declare(strict_types=1);

namespace Application\Network\Actions;

use App\Application\Network\Responses\Index as Response;
use App\Domain\Network\Services\NetworkReader as Reader;
use Illuminate\Contracts\Support\Responsable;

class Index
{
    public function __invoke(Reader $reader, Response $response): Responsable
    {
        return $response->setNetworks(
            $reader->getAll()
        );
    }
}
