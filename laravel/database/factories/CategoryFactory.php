<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => join(' ', $faker->words(5)),
        'slug' => Str::slug(join(' ', $faker->words(5))),
        'description' => $faker->text(200),
        'file_name' =>$faker->imageUrl(),
    ];
});
