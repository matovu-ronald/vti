<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Vti::class, function (Faker $faker) {
    return [
        'business_id' => function () {
            return factory('App\Models\Business')->create()->id;
        },
        'name' => $faker->name,
        'logo' => '/uploads/vti-logo.jpg',
        'location' => $faker->address,
        'about' => $faker->paragraph(10),
    ];
});
