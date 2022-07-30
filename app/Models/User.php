<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\RoleKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;

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
  ];

  public function role(): BelongsTo
  {
    return $this->belongsTo(Role::class);
  }

  public function flightInformationRegions(): BelongsToMany
  {
    return $this->belongsToMany(FlightInformationRegion::class);
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
