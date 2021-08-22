<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

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
        'processed_at' => $faker->dateTime('now', 'UTC-3'),
        'amount' => $faker->randomFloat(2, 1, 1000),
        'credit_card' => $faker->creditCardNumber,
        'document' => $faker->numerify('###########'),
    ];
});
