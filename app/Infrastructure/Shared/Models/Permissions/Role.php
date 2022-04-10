<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Models\Permissions;

use App\Infrastructure\Shared\Concerns\ModelHasId;
use App\Infrastructure\Shared\Concerns\ModelHasName;
use Infrastructure\Shared\Contracts\HasId;
use Infrastructure\Shared\Models\Teams\Team;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole implements HasId
{
    use ModelHasName;
    use ModelHasId;

    public function forTeam(Team $team): self
    {
        $this->attributes['team_id'] = $team->getId();

        return $this;
    }
}
