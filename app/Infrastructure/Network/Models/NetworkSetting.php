<?php

declare(strict_types=1);

namespace Infrastructure\Network\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NetworkSetting extends Model
{
    protected $fillable = [
        'attachable',
        'gateway',
        'ipv6',
    ];

    protected $casts = [
        'attachable' => 'boolean',
        'ipv6' => 'boolean',
    ];

    public function network(): BelongsTo
    {
        return $this->belongsTo(Network::class);
    }
}
