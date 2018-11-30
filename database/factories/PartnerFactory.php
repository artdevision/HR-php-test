<?php

use Faker\Generator as Faker;

$factory->define(App\Partner::class, function (Faker $faker) {
    return [
        //
        'email' => $faker->unique(true)->companyEmail,
        'name'  => $faker->company,
    ];
});
