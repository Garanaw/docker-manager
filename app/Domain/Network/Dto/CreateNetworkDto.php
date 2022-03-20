<?php

declare(strict_types=1);

namespace App\Domain\Network\Dto;

use App\Domain\Network\Caster\EnumCaster\DriverCaster;
use App\Domain\Network\Caster\EnumCaster\ScopeCaster;
use App\Domain\Network\Enum\Driver;
use App\Domain\Network\Enum\Scope;
use Infrastructure\Shared\Models\User;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class CreateNetworkDto extends DataTransferObject
{
    public string $name;
    public ?string $description;
    #[CastWith(DriverCaster::class)]
    public Driver $driver;
    #[CastWith(ScopeCaster::class)]
    public Scope $scope;
    public ?string $gateway;
    public bool $attachable;
    public bool $ipv6;
    public User $user;

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getDriver(): Driver
    {
        return $this->driver;
    }

    public function getScope(): Scope
    {
        return $this->scope;
    }

    public function getGateway(): ?string
    {
        return $this->gateway;
    }

    public function isAttachable(): bool
    {
        return $this->attachable;
    }

    public function isIpv6(): bool
    {
        return $this->ipv6;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function networkDataToArray(): array
    {
        return [
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'scope' => $this->getScope()->value,
            'is_active' => false,
        ];
    }
}
