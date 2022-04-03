<?php

namespace App\Policies;

use Infrastructure\Shared\Models\Teams\Team;
use Infrastructure\Shared\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Team $team): bool
    {
        return $user->belongsToTeam($team);
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    public function addTeamMember(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    public function updateTeamMember(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    public function removeTeamMember(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    public function delete(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }
}
