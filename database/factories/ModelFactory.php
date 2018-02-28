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

/** Person */
$factory->define(App\Person::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'surname' => $faker->lastName,
    ];
});

/** Post */
$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'slug' => $faker->slug(),
        'content' => $faker->paragraphs(3, true),
        'eloquent_snake_case' => 'A column name in snake case format, which needs to be transformed to kebab case',
        'author_id' => function () {
            return factory(App\Person::class)->create()->getKey();
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
        'person_id' => function () {
            return factory(App\Person::class)->create()->getKey();
        },
    ];
});

/** Tag */
$factory->define(App\Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->country,
    ];
});
