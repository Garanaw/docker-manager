<?php

declare(strict_types=1);

namespace Domain\Network\Caster\EnumCaster;

use Domain\Network\Enum\Driver;
use Spatie\DataTransferObject\Caster;

class DriverCaster implements Caster
{
    public function cast(mixed $value): ?Driver
    {
        return Driver::tryFrom($value);
    }
}
