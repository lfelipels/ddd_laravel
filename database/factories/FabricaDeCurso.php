<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Ddd\Arquitetura\Dominios\Academico\Curso\Curso;
use Ddd\Arquitetura\Model;
use Faker\Generator as Faker;

$factory->define(Curso::class, function (Faker $faker) {
    return [
        'nome' => $faker->word(),
        'duracao' => $faker->time('H')
    ];
});
