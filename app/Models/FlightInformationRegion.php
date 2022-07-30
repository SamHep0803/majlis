<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
