<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\BookCategory;
use Faker\Generator as Faker;

$factory->define(BookCategory::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\Lorem($faker));
    return [
        'name' => $faker->sentence,
        'description' => $faker->text,
    ];
});
