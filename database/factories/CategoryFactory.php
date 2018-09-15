<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->country(),
        'description' => $faker->text(200),
        'state' => $faker->randomFloat(1,0,1),
    ];
});
