<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Vente::class, function (Faker $faker) {
    $status = ['En cours', 'Annulée', 'Vendu'];
    return [
        'status' => $status[array_rand($status)],
        'date_parution' => $faker->date(),
        'date_vente' => null,
        'id_bien' => 1,
    ];
});
