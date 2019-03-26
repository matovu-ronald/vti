<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Vti::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'logo' => '/uploads/vti-logo.jpg',
        'location' => $faker->address,
        'about' => $faker->paragraph(10),
    ];
});
