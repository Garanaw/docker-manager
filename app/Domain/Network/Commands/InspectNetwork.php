<?php

declare(strict_types=1);

namespace App\Domain\Network\Commands;

use App\Domain\Shared\Executor\DockerCommand;

class InspectNetwork implements DockerCommand
{
    private const COMMAND = 'docker network inspect';

    private ?string $networkName = null;

    public function buildCommand(): string
    {
        $networkName = $this->getNetworkName();

        return sprintf('%s %s', $this->getCommand(), $networkName);
    }

    public function setNetworkName(string $networkName): self
    {
        $this->networkName = $networkName;

        return $this;
    }

    public function getNetworkName(): string
    {
        if ($this->networkName === null) {
            throw new \RuntimeException('Network name is not set');
        }

        return $this->networkName;
    }

    public function getCommand(): string
    {
        return self::COMMAND;
    }
}
