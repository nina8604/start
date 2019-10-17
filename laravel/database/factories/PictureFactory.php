<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Picture;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Picture::class, function (Faker $faker) {
    return [
        'product_id' => Product::inRandomOrder()->first()->id,
    ];
});
