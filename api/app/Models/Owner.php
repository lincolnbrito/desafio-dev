<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Owner extends Model
{
    protected $fillable = [
        'name'
    ];

    public function stores(): HasMany
    {
        return $this->hasMany(Store::class);
    }
}
