<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Agent::class, function (Faker $faker) {
    return [
        'nom' => $faker->lastName,
        'prenom' => $faker->firstName,
        'mail' => $faker->unique()->safeEmail,
        'mail_verif' => now(),
        'phone' => $faker->phoneNumber,
        'id_agence' => 1,
    ];
});
