<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Concerns;

trait ModelHasId
{
    public function getId(): int
    {
        return $this->attributes['id'];
    }
}
