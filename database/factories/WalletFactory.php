<?php

use Faker\Generator as Faker;

$factory->define(\App\Entity\Wallet::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\Entity\User::class)->create()->id;
        }
    ];
});
