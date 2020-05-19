<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Agence::class, function (Faker $faker) {
    return [
        'nom' => $faker->name,
        'ville' => $faker->city,
        'frais_agence' => random_int(5, 25),
    ];
});
