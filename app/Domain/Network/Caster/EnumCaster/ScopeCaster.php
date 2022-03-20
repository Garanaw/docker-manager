<?php

declare(strict_types=1);

namespace Domain\Network\Caster\EnumCaster;

use Domain\Network\Enum\Scope;
use Spatie\DataTransferObject\Caster;

class ScopeCaster implements Caster
{
    public function cast(mixed $value): ?Scope
    {
        return Scope::tryFrom($value);
    }
}
