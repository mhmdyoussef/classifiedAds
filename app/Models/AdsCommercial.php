<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class AdsCommercial extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'title',
        'description',
        'label',
        'category_id',
        'image',
        'phone',
        'whatsapp',
        'href',
        'package_id',
        'price',
        'views',
        'status',
        'is_featured',
        'is_active',
        'is_premium_extra',
        'is_approved',
        'is_negotiable'
    ];

    protected $casts = [
        'image' => 'array',
        'category_id' => 'int',
        'views' => 'int',
        'sort_order' => 'int',
        'status' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'is_premium_extra' => 'boolean',
        'is_approved' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(AdsCategory::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(AdsPackage::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function comment(): HasMany
    {
        return $this->hasMany(AdsComment::class, 'ads_id');
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class, 'ad_id');
    }
}
