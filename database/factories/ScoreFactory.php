<?php

use Faker\Generator as Faker;

$factory->define(App\Score::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(App\User::class)->create()->id;
        } ,
        'points' => rand(500, 9999),
        'played_time' => rand(10, 99),
    ];
});
