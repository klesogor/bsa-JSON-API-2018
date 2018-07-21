<?php

use Faker\Generator as Faker;

$factory->define(\App\Entity\Money::class, function (Faker $faker) {
    return [
        'amount' => $faker->numberBetween(0,1000),
    ];
});
