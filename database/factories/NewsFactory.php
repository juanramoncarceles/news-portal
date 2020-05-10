<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\News::class, function (Faker $faker) {
    return [
        'title' => $faker->text(40),
        'author' => $faker->randomElement(['Margarita Garcia', 'Jose Navarro', 'Luisa Perez', 'Valeria Orly', 'Felipe Sanchez', 'Almudena Cuesta']),
        'publication_date' => $faker->dateTimeThisYear(),
        'summary' => $faker->sentences(8, true),
        'body' => $faker->paragraphs(6, true)
    ];
});
