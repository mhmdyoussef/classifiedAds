<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'code',
        'symbol',
        'decimal_place',
        'status'
    ];

    protected $hidden = [
        'status',
        'created_at',
        'updated_at',
    ];
}
