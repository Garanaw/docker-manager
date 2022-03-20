<?php

declare(strict_types=1);

namespace Infrastructure\Network\Models;

use Infrastructure\Shared\Contracts\HasId;
use Illuminate\Database\Eloquent\Model;

class NetworkDriver extends Model implements HasId
{
    public function getId(): int
    {
        return (int)$this->attributes['id'];
    }
}
