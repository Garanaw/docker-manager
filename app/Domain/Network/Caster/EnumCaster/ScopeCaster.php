<?php

declare(strict_types=1);

namespace App\Domain\Network\Caster\EnumCaster;

use App\Domain\Network\Enum\Scope;
use Spatie\DataTransferObject\Caster;

class ScopeCaster implements Caster
{
    public function cast(mixed $value): ?Scope
    {
        return Scope::tryFrom($value);
    }
}
