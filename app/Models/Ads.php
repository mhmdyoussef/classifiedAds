<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ads extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'label',
        'client_id',
        'category_id',
        'attributes',
        'image',
        'phone',
        'whatsapp',
        'price',
        'latitude',
        'longitude',
        'package_id',
        'subscriptions_id',
        'status',
        'is_featured',
        'is_active',
        'is_premium_extra',
        'is_approved',
        'is_negotiable'
    ];

    protected $casts = [
        'image' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'sort_order' => 'int',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'is_premium_extra' => 'boolean',
        'is_approved' => 'boolean',
        'status' => 'boolean',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(AdsCategory::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(AdsPackage::class);
    }

    public function comment(): HasMany
    {
        return $this->hasMany(AdsComment::class, 'ads_id');
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class, 'ad_id');
    }

    protected function attributes(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }
}
