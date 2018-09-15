<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
*/

$factory->define(App\User::class, function (Faker $faker) {

    static $password;

    $filepath = storage_path('avatars');

    if (!File::exists($filepath)) {
        File::makeDirectory($filepath);
    }

    return [
        'name' => $faker->firstName(),
        'lastname' => $faker->lastName,
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'mobile' => $faker->phoneNumber(),
        'description' => $faker->text(30),
        'active' => $faker->randomFloat(1, 0, 1),
        'idrol' => 2,
        'image' => $faker->image('public/storage/images', 180, 180, null, false)
    ];
});
