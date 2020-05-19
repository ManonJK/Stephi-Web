<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Vente::class, function (Faker $faker) {
    return [
        'status' => array_rand(['En cours', 'Annulée', 'Vendu']),
        'date_parution' => $faker->date(),
        'date_vente' => null,
        'id_bien' => 1,
    ];
});
