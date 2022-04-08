<?php

declare(strict_types=1);

namespace App\Domain\User\Services;

use App\Domain\User\Dto\CreateUserDto;
use App\Infrastructure\User\Creator as Repository;
use Infrastructure\Shared\Models\User;

class Creator
{
    public function __construct(private Repository $creator)
    {
    }

    public function create(CreateUserDto $data): User
    {
        return $this->creator->create($data);
    }
}
