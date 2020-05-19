<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Bien::class, function (Faker $faker) {
    $prix_min = random_int(10000, 50000);
    $prix_max = random_int($prix_min, 500000);
    return [
        'superficie' => random_int(5, 300),
        'nb_pieces' => random_int(1, 10),
        'etage' => random_int(0, 8),
        'localisation' => $faker->address,
        'descriptif' => $faker->text,
        'prix_min' => $prix_min,
        'prix_max' => $prix_max,
        'prix_vente' => random_int($prix_min, $prix_max),
        'id_user' => 1,
        'id_type' => 1,
    ];
});
