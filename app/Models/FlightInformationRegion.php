<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FlightInformationRegion extends Model
{
    protected $fillable = [
        'identifier',
        'name',
    ];

    public function vACC(): BelongsTo
    {
        return $this->belongsTo(vACC::class);
    }

    protected function identifier(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtoupper($value)
        );
    }

    protected function identifierName(): Attribute
    {
        return new Attribute(
            fn () => "{$this->identifier} | {$this->name}"
        );
    }
}
