<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Translatable\HasTranslations;

class AdsPackage extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'label',
        'duration',
        'price',
        'is_featured',
        'is_premium_package',
        'sort_order',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_premium_package' => 'boolean',
        'status' => 'boolean',
    ];

    public array $translatable = [
        'title',
        'description',
        'label',
    ];

}
