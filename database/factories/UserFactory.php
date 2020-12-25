<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'fname' => $faker->firstName,
        'lname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'phonecode' => now(),
        'phone' => $faker->PhoneNumber,
        'phone_verified_at' => now(),
        'password' => '$2y$10$cwJE.SURWdZ0YFAiuUB5Ne.Ei9X0VGwMtWfzuaMxfRZgOIx4J/kbG', // 123456
    ];
});
$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => 'admin@example.com',
        'password' => '$2y$10$cwJE.SURWdZ0YFAiuUB5Ne.Ei9X0VGwMtWfzuaMxfRZgOIx4J/kbG', // 123456
    ];
});
