<?php

declare(strict_types=1);

namespace Infrastructure\Network\Models;

use Infrastructure\Shared\Contracts\HasId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Infrastructure\Shared\Models\User;

class Network extends Model implements HasId
{
    protected $fillable = [
        'name',
        'network_id',
        'driver',
        'scope',
        'is_active',
        'description',
        'network_driver_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function settings(): HasOne
    {
        return $this->hasOne(NetworkSetting::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(NetworkDriver::class);
    }

    public function getId(): int
    {
        return (int)$this->attributes['id'];
    }
}
