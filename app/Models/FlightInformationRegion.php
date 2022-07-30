<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\FlightInformationRegion
 *
 * @property int $id
 * @property string $identifier FIR Identifier e.g OMAE
 * @property string $name The name of the FIR, e.g Emirates ACC
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FlightInformationRegion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FlightInformationRegion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FlightInformationRegion query()
 * @method static \Illuminate\Database\Eloquent\Builder|FlightInformationRegion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlightInformationRegion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlightInformationRegion whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlightInformationRegion whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlightInformationRegion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FlightInformationRegion extends Model
{
  protected $fillable = [
    'identifier',
    'name'
  ];

  public function users(): BelongsToMany
  {
    return $this->belongsToMany(User::class)->withTimestamps();
  }

  protected function identifier(): Attribute
  {
    return Attribute::make(
      get: fn ($value) => strtoupper($value),
      set: fn ($value) => strtoupper($value)
    );
  }
}
