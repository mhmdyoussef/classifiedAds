<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AdsFavorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'ads_id',
        'ad_type',
    ];

    protected $casts = [
        'ads_id' => 'int',
    ];

    protected $hidden = [
        'ad_type',
        'created_at',
        'updated_at',
    ];

    public function adsCommercial(): BelongsTo
    {
        return $this->belongsTo(AdsCommercial::class, 'ads_id', 'id');
    }

    public function adsStore(): HasOne
    {
        return $this->hasOne(AdsCommercial::class, 'id', 'ads_id');
    }

    public function adsTrend(): HasOne
    {
        return $this->hasOne(AdsCommercial::class, 'id', 'ads_id');
    }

    public function ads(): HasOne
    {
        return $this->hasOne(AdsCommercial::class, 'id', 'ads_id');
    }

}
