<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

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
        'user_name' => $faker->name,
        'user_email' => $faker->unique()->safeEmail,
        'user_password' => '$2y$10$crmroUiuL9hDckw9bHMg3Ots26nMZANyiFyZp4s3ARich1e/wsA4S', // 123456
        'user_status' => 0,
        'user_active_key' => Str::random(20),
        'first_login' => now(),
        'last_login' => now(),
        'active_email_at' => now(),
        'remember_token' => Str::random(10),
    ];
});
