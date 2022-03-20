<?php

declare(strict_types=1);

namespace App\Domain\Network\Caster\EnumCaster;

use App\Domain\Network\Enum\Driver;
use Spatie\DataTransferObject\Caster;

class DriverCaster implements Caster
{
    public function cast(mixed $value): ?Driver
    {
        return Driver::tryFrom($value);
    }
}
