<?php

use App\Comment;
use App\Person;
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

        /** @var array $people */
        $people = factory(Person::class, 5)
            ->create()
            ->map(function (Person $person) {
                return $person->getKey();
            })
            ->all();

        $person = function () use ($faker, $people) {
            return $faker->randomElement($people);
        };

        /** @var Collection $tags */
        $tags = factory(Tag::class, 10)->create();

        factory(Post::class, 50)->create([
            'author_id' => $person,
        ])->each(function (Post $post) use ($faker, $person, $tags) {
            factory(Comment::class, $faker->numberBetween(1, 10))->create([
                'post_id' => $post->getKey(),
                'person_id' => $person,
            ]);

            $post->tags()->save($tags->random());
        });
    }
}
