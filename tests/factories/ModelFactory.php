<?php

$factory->define(\RafflesArgentina\UserAction\Models\User::class, function (\Faker\Generator $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'name' => $faker->firstName,
        'password' => bcrypt(str_random()),
    ];
});

$factory->define(\RafflesArgentina\UserAction\Models\UserAction::class, function (\Faker\Generator $faker) {
    return [
        'model' => $faker->word,
        'action' => $faker->word,
        'model_id' => rand(0,3),
    ];
});
