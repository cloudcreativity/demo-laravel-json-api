<?php

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

/** @var EloquentFactory $factory */

/** User */
$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

/** Post */
$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'slug' => $faker->slug(),
        'content' => $faker->paragraphs(3, true),
        'published_at' => $faker->dateTime,
        'author_id' => function () {
            return factory(App\User::class)->create()->getKey();
        },
    ];
});

/** Comment */
$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph,
        'post_id' => function () {
            return factory(App\Post::class)->create()->getKey();
        },
        'user_id' => function () {
            return factory(App\User::class)->create()->getKey();
        },
    ];
});

/** Tag */
$factory->define(App\Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->country,
    ];
});
