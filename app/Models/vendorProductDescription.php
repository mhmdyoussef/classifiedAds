<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class vendorProductDescription extends Model
{
    use HasFactory;

    public function language(): HasOne
    {
        return $this->hasOne(Language::class, 'id');
    }
}
