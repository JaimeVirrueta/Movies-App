<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Turn;
use Faker\Generator as Faker;

$factory->define(Turn::class, function (Faker $faker) {
    return [
        'turn_name' => $faker->unique()->time('H:i'),
        'is_active' => $faker->randomElement([true, true, false]), /** greaterG probability to get true values */
    ];
});
