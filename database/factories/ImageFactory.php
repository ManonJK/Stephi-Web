<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Image;
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

$factory->define(App\Image::class, function (Faker $faker) {
    $liens = ['images/fakeimg', 'images/fakeimg2', 'images/fakeimg3', 'images/fakeimg4', 'images/fakeimg5'];
    return [
        'lien' => $liens[array_rand($liens)],
        'id_bien' => 1,
    ];
});
