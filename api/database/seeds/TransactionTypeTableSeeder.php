<?php

use Illuminate\Database\Seeder;

use App\Enum\TransactionTypeEnum;
use App\Models\TransactionType;
class TransactionTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [];

       foreach(TransactionTypeEnum::getValues() as $type) {
            $records[] =  [
                'id' => $type['id'],
                'description' => $type['description'],
                'type' => $type['type'],
                'operator' => $type['operator'],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        $model = new TransactionType;
        dd($model->insert($records));

    }
}
