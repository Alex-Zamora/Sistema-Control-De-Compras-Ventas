<?php

use Faker\Generator as Faker;

$factory->define(App\Categoria::class, function (Faker $faker) {
    return [
        'nombre' => $faker->sentence(3),
        'descripcion' => $faker->text(200),
        'condicion' => 1
    ];
});
