<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enum\TransactionTypeEnum;
use App\Models\TransactionType;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(TransactionType::class, function (Faker $faker) {
    return [
        'description' => $faker->text(30),
        'type' => $faker->randomElement([TransactionTypeEnum::INCOME, TransactionTypeEnum::EXPENSE]),
        'operator' => $faker->randomElement(['+', '-']),
    ];
});
