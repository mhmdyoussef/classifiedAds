<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'ads_id',
        'type',
        'rate',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
