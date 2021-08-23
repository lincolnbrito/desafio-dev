<?php

namespace App\Services;

use App\Models\Store;

class StoreService
{
    public function getModel(): Store
    {
        return new Store;
    }

    public function paginate($limit = 30)
    {
       return $this->getModel()->paginate($limit);
    }

    public function import($name, $owner) {
       $store = $this->getModel()->firstOrCreate([
           'name' => $name,
           'owner_id' => $owner->id
       ], [
           'balance' => 0,
           'owner_id' => $owner->id
       ]);

       return $store;
    }
}
