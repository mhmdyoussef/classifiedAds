<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'country_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'country_id',
    ];

    public array $translatable = [
        'title',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function zone(): HasMany
    {
        return $this->hasMany(Zone::class, 'city_id');
    }
}
