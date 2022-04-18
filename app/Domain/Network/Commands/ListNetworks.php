<?php

declare(strict_types=1);

namespace App\Domain\Network\Commands;

use App\Domain\Shared\Executor\DockerCommand;

class ListNetworks implements DockerCommand
{
    private const COMMAND = 'docker network ls';

    public function buildCommand(): string
    {
        return self::COMMAND;
    }
}
