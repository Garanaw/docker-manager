<?php

declare(strict_types=1);

namespace App\Infrastructure\User;

use Infrastructure\Shared\Models\Teams\Team;
use Infrastructure\Shared\Models\User;

class TeamsCreator
{
    public function __construct(private Team $model)
    {
    }

    public function createPersonalTeam(User $user): Team
    {
        return tap($this->model->forceCreate([
            'user_id' => $user->getId(),
            'name' => explode(' ', $user->getName(), 2)[0]."'s Team",
            'personal_team' => true,
        ]), function (Team $team) use ($user) {
            $user->ownedTeams()->save($team);
        });
    }
}
