<?php

declare(strict_types=1);

namespace Application\Shared\Request\Contracts;

use Spatie\DataTransferObject\DataTransferObject;

interface ContainsDto
{
    public function getDto(): string;

    public function toDto(): DataTransferObject;

    public function toGivenDto(string $dto): DataTransferObject;
}
