<?php

declare(strict_types=1);

namespace Infrastructure\Shared\Models;

use App\Infrastructure\Shared\Concerns\ModelHasId;
use App\Infrastructure\Shared\Concerns\ModelHasName;
use Infrastructure\Network\Models\Network;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Infrastructure\Shared\Contracts\HasId;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, HasId
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use SoftDeletes;
    use HasRoles;
    use ModelHasId;
    use ModelHasName;

    /** @var array<int, string> */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /** @var array<int, string> */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function networks(): HasMany
    {
        return $this->hasMany(Network::class);
    }
}
