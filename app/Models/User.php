<?php

namespace App\Models;

use App\Enums\RoleKey;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'role_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'role_id' => 'integer',
        'vacc_id' => 'integer',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function vacc(): BelongsTo
    {
        return $this->belongsTo(vACC::class);
    }

    public function canAccessFilament(): bool
    {
        return true;
    }

    public function getAssignableRoles(): array
    {
        switch ($this->role->key) {
            case RoleKey::SYS:
                return RoleKey::cases();
            case RoleKey::VDI:
                return [
                    RoleKey::VACC_STAFF,
                    RoleKey::EVENT,
                    RoleKey::USER,
                ];
            default:
                return [];
        }
    }
}
