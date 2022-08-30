<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\model\message;
use Faker\Generator as Faker;

$factory->define(message::class, function (Faker $faker) {
    return [
        'is_seen'=>$faker->numberBetween($min = 0,$max = 1),
        'is_user_seen'=>$faker->numberBetween($min = 0,$max = 1),
        'sender'=>$faker->numberBetween($min = 231,$max = 266),
        'recever'=>$faker->numberBetween($min = 231,$max = 266),
        'message'=>$faker->text($maxNBChars = 150),
    ];
});
