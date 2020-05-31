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
    $nom = $faker->unique()->lastName;
    $prenom = $faker->unique()->firstName;
    return [
        'nom' => strtoupper($nom),
        'prenom' => $prenom,
        'email' => $nom.'.'.$prenom.'@example.net',
        'mail_verif' => now(),
        'phone' => $faker->phoneNumber,
        'birth_date' => $faker->date(),
        'id_agent' => null,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
