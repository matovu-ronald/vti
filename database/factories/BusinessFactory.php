<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Business::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'logo' => '/uploads/business-logo.png',
        'location' => $faker->address,
        'about' => $faker->paragraph(10),
    ];
});
