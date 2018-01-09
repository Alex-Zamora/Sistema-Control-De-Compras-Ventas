<?php

use Faker\Generator as Faker;

$factory->define(App\Articulo::class, function (Faker $faker) {
    return [
        'id_categoria' => rand(1,20),
        'codigo' => 'unique:ean8',
        'nombre' => $faker->sentence(3),
        'stock' => rand(5,20),
        'descripcion' => $faker->text(200),
    ];
});
