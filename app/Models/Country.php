<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'iso_code',
    ];

    public array $translatable = [
        'name',
    ];

    public function city(): HasMany
    {
        return $this->hasMany(City::class, 'country_id');
    }

}
