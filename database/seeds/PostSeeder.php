<?php

use App\Comment;
use App\User;
use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Collection;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Faker $faker */
        $faker = app(Faker::class);

        /** @var array $users */
        $users = factory(User::class, 5)->create()->map(function (User $person) {
            return $person->getKey();
        })->all();

        $user = function () use ($faker, $users) {
            return $faker->randomElement($users);
        };

        /** @var Collection $tags */
        $tags = factory(Tag::class, 10)->create();

        factory(Post::class, 50)->create([
            'author_id' => $user,
        ])->each(function (Post $post) use ($faker, $user, $tags) {
            factory(Comment::class, $faker->numberBetween(1, 10))->create([
                'post_id' => $post->getKey(),
                'user_id' => $user,
            ]);

            $post->tags()->save($tags->random());
        });
    }
}
