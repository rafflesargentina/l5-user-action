<?php

$factory->define(\RafflesArgentina\UserAction\Models\User::class, function (\Faker\Generator $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'name' => $faker->firstName,
        'password' => bcrypt(str_random()),
    ];
});

$factory->define(\RafflesArgentina\UserAction\Models\Article::class, function (\Faker\Generator $faker) {
    return [
        'title' => $faker->text,
        'body' => $faker->text,
        'user_id' => factory(\RafflesArgentina\UserAction\Models\User::class)->create()->id,
    ];
});

$actions = [
    'retrieved',
    'creating',
    'created',
    'updating',
    'updated',
    'saving',
    'saved',
    'deleting',
    'deleted',
    'restoring',
    'restored'
];

$factory->define(\RafflesArgentina\UserAction\Models\UserAction::class, function (\Faker\Generator $faker) use ($actions) {
    return [
        'model' => 'Article',
        'action' => array_rand($actions, 1),
        'user_id' => factory(\RafflesArgentina\UserAction\Models\User::class)->create()->id,
        'model_id' => factory(\RafflesArgentina\UserAction\Models\Article::class)->create()->id,
    ];
});
