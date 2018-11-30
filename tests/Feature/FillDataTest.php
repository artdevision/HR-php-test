<?php

namespace Tests\Feature;

use Illuminate\Support\Collection;
use Tests\TestCase;
use Faker\Generator as Faker;
use Faker\Factory as Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FillDataTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFillFakedData()
    {
        $faker = Factory::create();


        $partners = factory(\App\Partner::class, 15)->create();

        $partners_ids = $partners->map(function($item) { return $item->id; })->toArray();

        $vendors = factory(\App\Vendor::class, 20)->create();

        $vendor_ids = $vendors->map(function($item) { return $item->id; })->toArray();

        $products = factory(\App\Product::class, 100)->make()
            ->each(function(\App\Product $product) use ($faker, $vendor_ids) {
                $product->fill([
                    'vendor_id' => $faker->randomElement($vendor_ids)
                ]);
                $product->save();
            });

        $orders = factory(\App\Order::class, 30)->make()->each(function ($item) use($products, $partners_ids, $faker) {
            $item->fill([
                'partner_id' => $faker->randomElement($partners_ids),
            ]);
            $item->save();
            $sync = [];
            $products->shuffle()->take($faker->numberBetween(1, 5))->each(function ($item)  use($faker, &$sync) {
                    $quantity = $faker->numberBetween(1,10);
                    $sync[$item->id] = [
                        'quantity' => $quantity,
                        'price' => $quantity * $item->price,
                    ];
            });
            $item->products()->sync($sync);
        });

        $this->assertTrue(true);
    }
}
