<?php

declare(strict_types=1);

namespace App\Infrastructure\User;

use App\Domain\User\Dto\CreateUserDto;
use App\Infrastructure\Shared\Models\Permissions\Role;
use Illuminate\Database\DatabaseManager as DB;
use Illuminate\Support\Str;
use Infrastructure\Shared\Models\User;

class Creator
{
    public function __construct(
        private User $model,
        private TeamsCreator $teamsCreator,
        private Role $role,
        private DB $db
    ) {
    }

    public function create(CreateUserDto $data): User
    {
        return $this->db->transaction(function () use ($data) {
            return tap($this->model->create($data->toArray()), function (User $user) use ($data) {
                $this->teamsCreator->createPersonalTeam($user);

                /** @var Role $role */
                $role = $this->role->where('name', '=', Str::lower('admin'))->first();
                setPermissionsTeamId($user->refresh()->personalTeam()->getId());
                $user->assignRole($role);
            });
        });
    }
}
