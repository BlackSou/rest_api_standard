<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Play;
use Faker\Generator as Faker;

$factory->define(Play::class, function (Faker $faker) {
    return [
        'title' => $faker->string(5),
        'description' => $faker->text(300),
        'complexity' => $faker->complexity,
        'isActive' => $faker->boolean,
    ];
});
