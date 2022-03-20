<?php

declare(strict_types=1);

namespace Infrastructure\Network\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Infrastructure\Shared\Contracts\HasId;
use Illuminate\Database\Eloquent\Model;

class NetworkDriver extends Model implements HasId
{
    public function getId(): int
    {
        return (int)$this->attributes['id'];
    }

    public function networks(): HasMany
    {
        return $this->hasMany(Network::class);
    }
}
