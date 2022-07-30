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

/**
 * App\Models\User
 *
 * @property int $id The user's VATSIM CID
 * @property string $name
 * @property int $role_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $token
 * @property string|null $refresh_token
 * @property string|null $refresh_token_expires_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FlightInformationRegion[] $flightInformationRegions
 * @property-read int|null $flight_information_regions_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Role $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRefreshTokenExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
