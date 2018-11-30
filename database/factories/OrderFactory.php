<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        //
        'status' => $faker->randomElement([0, 10, 20]),
        'client_email' => $faker->unique(true)->email,
        'delivery_dt'  => $faker->dateTimeBetween('-3 days', '+10 days')
//        'partner_id' =>
    ];
});
