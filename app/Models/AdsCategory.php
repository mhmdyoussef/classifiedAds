<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Spatie\Translatable\HasTranslations;

class AdsCategory extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'parent_id',
        'image',
        'icon',
        'sort_order',
        'is_featured',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'image' => 'array',
        'is_featured' => 'boolean',
        'status' => 'boolean',
    ];

    public array $translatable = [
        'title',
        'description',
        'label',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(AdsCategory::class);
    }

}
