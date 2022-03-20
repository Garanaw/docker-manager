<?php

declare(strict_types=1);

namespace App\Domain\Network\Enum;

use Illuminate\Support\Collection;

enum Scope: string
{
    case Local = 'local';
    case Swarm = 'swarm';

    public function isLocal(): bool
    {
        return $this === self::Local;
    }

    public function isSwarm(): bool
    {
        return $this === self::Swarm;
    }

    public static function all(): Collection
    {
        return collect([
            self::Local,
            self::Swarm,
        ]);
    }

    public static function forValidation(): string
    {
        return self::all()->map->value->implode(',');
    }
}
