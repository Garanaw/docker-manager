<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Models\Permissions;

use App\Infrastructure\Shared\Concerns\ModelHasName;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    use ModelHasName;
}
