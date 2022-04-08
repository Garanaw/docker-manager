<?php

declare(strict_types=1);

namespace App\Domain\User\Dto;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Collection;
use Spatie\DataTransferObject\DataTransferObject;

class CreateUserDto extends DataTransferObject implements Arrayable
{
    public string $name;
    public string $email;
    public string $password;

    public ?Collection $roles = null;

    public function hasRoles(): bool
    {
        return $this->roles instanceof Collection && $this->roles->isNotEmpty();
    }

    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function getUserData(): array
    {
        return $this->only('name', 'email', 'password')->toArray();
    }
}
