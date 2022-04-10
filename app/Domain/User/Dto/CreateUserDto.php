<?php

declare(strict_types=1);

namespace App\Domain\User\Dto;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class CreateUserDto extends DataTransferObject implements Arrayable
{
    public string $name;
    public string $email;
    public string $password;
    public Carbon $email_verified_at;
}
