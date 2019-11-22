<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Ticket::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->text,
        'state' => $faker->randomElement(['open', 'pending', 'resolved', 'closed']),
        'priority' => $faker->randomNumber(),
        'author_id' => 1,
    ];
});
