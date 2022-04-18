<?php

declare(strict_types=1);

namespace App\Domain\Shared\Executor;

interface DockerCommand
{
    public function buildCommand(): string;
}
