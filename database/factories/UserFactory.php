<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

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

$factory->define(App\Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => 'jajith60@gmail.com',
        'password' => Hash::make('ajith1'),
        'remember_token' => str_random(10),
    ];
});
