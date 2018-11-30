<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->text(191),
        'price' => $faker->numberBetween(100, 100000),
//        'vendor_id' => function() {
//                return factory(\App\Vendor::class)->create()->id;
//        }
    ];
});
