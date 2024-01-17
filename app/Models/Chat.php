<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'starter_id',
        'ads_title',
    ];

    public function message(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function starter(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'starter_id');
    }
}
