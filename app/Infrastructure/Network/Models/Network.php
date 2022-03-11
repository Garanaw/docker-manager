<?php

declare(strict_types=1);

namespace App\Infrastructure\Network\Models;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    protected $fillable = [
        'name',
        'network_id',
        'driver',
        'scope',
        'is_active',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
