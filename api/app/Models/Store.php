<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Store extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'balance'
    ];

    protected function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }
}
