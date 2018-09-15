<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'name' => $faker->company(),
        'description' => $faker->text(200),
        'active' => $faker->randomFloat(1,0,1),
        'idcategory' => App\Category::all()->random()->id,
    ];
});
