<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Contracts;

interface HasId
{
    public function getId(): int;
}
