<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Word;
use Faker\Generator as Faker;

$factory->define(Word::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'word' => 'test'
    ];
});
