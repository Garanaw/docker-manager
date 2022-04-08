<?php

declare(strict_types=1);

namespace App\Infrastructure\User;

use App\Domain\User\Dto\CreateUserDto;
use App\Infrastructure\Shared\Models\Permissions\Role;
use Illuminate\Database\DatabaseManager as DB;
use Infrastructure\Shared\Models\Teams\Team;
use Infrastructure\Shared\Models\User;

class Creator
{
    public function __construct(
        private User $model,
        private Team $teamModel,
        private Role $roleModel,
        private DB $db
    ) {
    }

    public function create(CreateUserDto $data): User
    {
        return $this->db->transaction(function () use ($data) {
            return tap($this->model->create($data->getUserData()), function (User $user) use ($data) {
                $user->ownedTeams()->save($this->teamModel->forceCreate([
                    'user_id' => $user->id,
                    'name' => explode(' ', $user->name, 2)[0]."'s Team",
                    'personal_team' => true,
                ]));

                $role = $data->hasRoles()
                    ? $data->getRoles()
                    : $this->roleModel->where('name', 'user')->first();

                $user->assignRole($role);
            });
        });
    }
}
