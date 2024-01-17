<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Translatable\HasTranslations;

class Zone extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'city_id',
        'language_id',
        'title',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public array $translatable = [
        'title',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
