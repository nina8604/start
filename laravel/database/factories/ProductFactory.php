<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    static $index = 0;
    return [
        'sku' => $faker->numberBetween(0,100000)+(++$index),
        'name' => join(' ', $faker->words(5)),
        'slug' => Str::slug(join(' ', $faker->words(5))),
        'description' => $faker->text(200),
        'price' => $faker->randomFloat(2,0,1000),
        'category_id' => Category::inRandomOrder()->first()->id,
    ];
});
