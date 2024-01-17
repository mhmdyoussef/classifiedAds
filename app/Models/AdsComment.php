<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdsComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'ads_id',
        'ad_type',
        'comment',
    ];

    protected $hidden = [
        'ad_type',
        'ads_id',
        'is_approved',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
