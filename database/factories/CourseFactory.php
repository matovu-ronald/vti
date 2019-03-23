<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Course::class, function (Faker $faker) {
    return [
        'vti_id' => function () {
            return factory('App\Models\Vti')->create()->id;
        },
        'name' => $faker->sentence(3),
        'description' => $faker->sentence(5),
    ];
});
