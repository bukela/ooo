<?php

use Faker\Generator as Faker;

$factory->define(App\News::class, function (Faker $faker) {
    return [
        'flyer' => $faker->image('public/storage/images',400,300, null, false),
    ];
});
