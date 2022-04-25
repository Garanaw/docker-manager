<?php

declare(strict_types=1);

namespace App\Infrastructure\User;

use App\Domain\User\Dto\CreateUserDto;
use App\Infrastructure\Shared\Models\Permissions\Role;
use Illuminate\Database\DatabaseManager as DB;
use Illuminate\Hashing\HashManager;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Infrastructure\Shared\Models\User;

class Creator
{
    public function __construct(
        private User $model,
        private Role $role,
        private HashManager $hasher,
        private DB $db
    ) {
    }

    public function create(CreateUserDto $data): User
    {
        return $this->db->transaction(function () use ($data) {
            $userData = $data->getUserData();
            $userData['password'] = $this->hasher->make($userData['password']);

            if ($userData['email_verified_at'] instanceof Carbon) {
                $userData['email_verified_at'] = $userData['email_verified_at']->toDateTimeString();
            }

            return tap($this->model->create($userData), function (User $user) use ($data) {
                $roleName = $data->hasRole()
                    ? $data->getRole()
                    : 'admin';

                /** @var Role $role */
                $role = $this->role->where('name', '=', Str::lower($roleName))->first();
                $user->assignRole($role);
            });
        });
    }
}
