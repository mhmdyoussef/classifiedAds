<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Translatable\HasTranslations;

class AdsAttribute extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'category_id',
        'attribute_name',
        'attribute_value',
        'attribute_type',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'status',
    ];

    protected $casts = [
        'attribute_value' => 'array',
        'status' => 'boolean',
    ];

    public array $translatable = [
        'attribute_name',
        'attribute_value',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(AdsCategory::class);
    }
}
