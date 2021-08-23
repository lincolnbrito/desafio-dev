<?php

namespace App\Services;

use App\Models\Owner;

class OwnerService
{
    public function getModel() {
        return new Owner;
    }

    public function paginate($limit = 30)
    {
        return $this->getModel()->paginate($limit);
    }

    public function find($id)
    {
        return $this->getModel()->findOrFail($id);
    }

    public function import($name) {
       return $this->getModel()->firstOrCreate([
            'name' => $name
       ]);
    }
}
