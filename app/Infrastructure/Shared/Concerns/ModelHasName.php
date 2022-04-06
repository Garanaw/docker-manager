<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Concerns;

trait ModelHasName
{
    public function getName(): ?string
    {
        return $this->attributes['name'] ?? null;
    }

    public function setName(string $name): static
    {
        $this->attributes['name'] = $name;

        return $this;
    }
}
