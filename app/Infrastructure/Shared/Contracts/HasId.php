<?php

declare(strict_types=1);

namespace Infrastructure\Shared\Contracts;

interface HasId
{
    public function getId(): int;
}
