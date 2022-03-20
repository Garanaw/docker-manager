<?php

declare(strict_types=1);

namespace Domain\Network\Enum;

use Illuminate\Support\Collection;

enum Driver: string
{
    case Bridge = 'bridge';
    case Host = 'host';
    case Overlay = 'overlay';
    case Ipvlan = 'ipvlan';
    case Macvlan = 'macvlan';
    case None = 'none';

    public static function getAll(): Collection
    {
        return collect([
            self::Bridge,
            self::Host,
            self::Overlay,
            self::Ipvlan,
            self::Macvlan,
            self::None,
        ]);
    }

    public static function getCreatable(): Collection
    {
        return collect([
            self::Bridge,
            self::Host,
            self::Overlay,
            self::Ipvlan,
            self::Macvlan,
        ]);
    }

    public static function getNonCreatable(): Collection
    {
        return collect([
            self::None,
        ]);
    }

    public function isCreatable(): bool
    {
        return self::getCreatable()->contains($this);
    }
}
