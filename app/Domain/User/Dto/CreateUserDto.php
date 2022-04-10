<?php

declare(strict_types=1);

namespace App\Domain\User\Dto;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class CreateUserDto extends DataTransferObject implements Arrayable
{
    private const USER_DATA_FIELDS = [
        'name',
        'email',
        'password',
        'email_verified_at',
    ];

    public string $name;
    public string $email;
    public string $password;
    public Carbon $email_verified_at;
    public ?string $role_name = null;

    public function hasRole(): bool
    {
        return $this->role_name !== null;
    }

    public function getRole(): ?string
    {
        return $this->role_name;
    }

    public function getUserData(): array
    {
        return $this
            ->only(...self::USER_DATA_FIELDS)
            ->toArray();
    }
}
