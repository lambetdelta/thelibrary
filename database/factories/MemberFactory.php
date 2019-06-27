<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Member;
use Faker\Generator as Faker;

$factory->define(Member::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\en_US\Person($faker));
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
    ];
});
