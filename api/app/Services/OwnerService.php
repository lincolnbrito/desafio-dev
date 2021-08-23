<?php

namespace App\Services;

use App\Models\Owner;

class OwnerService
{
    public function getModel() {
        return new Owner;
    }

    public function import($name) {
       return $this->getModel()->firstOrCreate([
            'name' => $name
       ]);
    }
}
