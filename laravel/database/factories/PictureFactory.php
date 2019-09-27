<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Picture;
use Faker\Generator as Faker;

$factory->define(Picture::class, function (Faker $faker) {
    return [
        'path' => $faker->imageUrl(),
        'thumbnail' => $faker->imageUrl($width = 250, $height = 250),
    ];
});
