<?php

namespace App\Services;

use App\Models\TransactionType;

class TransactionTypeService
{
    public function getModel() {
        return new TransactionType();
    }

    public function paginate($limit = 30)
    {
        return $this->getModel()->paginate($limit);
    }

    public function find($id)
    {
        return $this->getModel()->findOrFail($id);
    }
}
