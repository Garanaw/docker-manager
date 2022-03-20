<?php

declare(strict_types=1);

namespace App\Infrastructure\Network\Models;

use App\Infrastructure\Shared\Contracts\HasId;
use Illuminate\Database\Eloquent\Model;

class NetworkDriver extends Model implements HasId
{
    public function getId(): int
    {
        return (int)$this->attributes['id'];
    }
}
