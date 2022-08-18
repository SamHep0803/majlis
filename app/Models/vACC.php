<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use function strtoupper;

class vACC extends Model
{
    protected $fillable = [
        'code',
        'name',
        'isMENA',
    ];

    protected $table = 'vaccs';

    public function flight_information_regions(): HasMany
    {
        return $this->hasMany(FlightInformationRegion::class, "vacc_id");
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function code(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtoupper($value)
        );
    }

    protected function codeName(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->code} | {$this->name}"
        );
    }
}
