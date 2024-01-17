<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AdsTrend extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'label',
        'image',
        'phone',
        'whatsapp',
        'href',
        'package_id',
        'client_id',
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
        'package_id' => 'int',
        'is_active' => 'boolean',
        'is_approved' => 'boolean',
        'is_premium_extra' => 'boolean',
        'is_featured' => 'boolean',
        'status' => 'boolean',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
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
}
