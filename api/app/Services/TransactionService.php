<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\TransactionType;
use Carbon\Carbon;

class TransactionService
{
    public function getModel() {
        return new Transaction();
    }

    public function import($data, $store) {

       $type = $this->getType($data['type']);
       $processed_at = Carbon::createFromFormat('Ymd His', $data['date'] . ' '. $data['hour']);

       $transaction = $this->getModel()->create([
           'processed_at' => $processed_at,
           'amount' => $data['amount'],
           'credit_card' => $data['credit_card'],
           'document' => $data['document'],
           'type_id' => $type->id,
           'store_id' => $store->id
       ]);

        if($type->operator === '+') {
            $store->increment('balance', $data['amount']);
        }

        if($type->operator === '-') {
            $store->decrement('balance', $data['amount']);
        }

       return $transaction;
    }

    public function getType($id) {
        return TransactionType::find($id);
    }
}
