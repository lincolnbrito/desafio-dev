<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'processed_at',
        'amount',
        'credit_card',
        'document',
        'type_id',
        'store_id'
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class);
    }
}
