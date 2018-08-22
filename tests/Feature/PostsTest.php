<?php

namespace Tests\Feature;

use App\Post;
use App\Tag;
use App\User;
use Laravel\Passport\Passport;

class PostsTest extends TestCase
{

    /**
     * @var string
     */
    protected $resourceType = 'posts';

    /**
     * Test the search route
     */
    public function testSearch()
    {
        // ensure there is at least one model in the database
        factory(Post::class, 2)->create();

        $this->doSearch([
            'page' => ['number' => 1, 'size' => 10],
        ])->assertSearchedMany();
    }

    /**
     * Test that we can search posts for specific ids
     */
    public function testSearchById()
    {
        $posts = factory(Post::class, 2)->create();
        // this model should not be in the search results
        factory(Post::class, 2)->create();

        $this->doSearchById($posts)
            ->assertSearchedIds($posts);
    }

    /**
     * Test the create resource route.
     */
    public function testCreate()
    {
        /** @var Tag $tag */
        $tag = factory(Tag::class)->create();
        $post = factory(Post::class)->make();

        $data = [
            'type' => 'posts',
            'attributes' => [
                'title' => $post->title,
                'slug' => $post->slug,
                'content' => $post->content,
                // Dates must be passed in Atom format for JSON_API
                'published-at' => $post->published_at->toAtomString(),
            ],
            'relationships' => [
                'tags' => [
                    'data' => [
                        [
                            'type' => 'tags',
                            'id' => (string) $tag->getKey(),
                        ],
                    ],
                ],
            ],
        ];

        Passport::actingAs($post->author);

        $id = $this
            ->doCreate($data, ['include' => 'author,tags'])
            ->assertCreatedWithId($data);

        $this->assertDatabaseHas('posts', [
            'id' => $id,
            'title' => $post->title,
            'slug' => $post->slug,
            'content' => $post->content,
            'published_at' => $post->published_at->toDateTimeString(),
            'author_id' => $post->author_id,
        ]);

        $this->assertDatabaseHas('post_tag', [
            'post_id' => $id,
            'tag_id' => $tag->getKey(),
        ]);
    }

    /**
     * Test the read resource route.
     */
    public function testRead()
    {
        $post = factory(Post::class)->create();
        $expected = $this->serialize($post);

        $this->doRead($post)->assertRead($expected);
    }

    /**
     * Test the update resource route.
     */
    public function testUpdate()
    {
        $post = factory(Post::class)->create();

        $data = [
            'type' => 'posts',
            'id' => (string) $post->getRouteKey(),
            'attributes' => [
                'slug' => 'posts-test',
                'title' => 'Foo Bar Baz Bat',
            ],
        ];

        Passport::actingAs($post->author);

        $this->doUpdate($data)->assertUpdated($data);

        $this->assertDatabaseHas('posts', [
            'id' => $post->getKey(),
            'slug' => $data['attributes']['slug'],
            'title' => $data['attributes']['title'],
            'content' => $post->content,
            'author_id' => $post->author_id,
        ]);
    }

    public function testUpdateForbidden()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();

        $data = [
            'type' => 'posts',
            'id' => (string) $post->getRouteKey(),
            'attributes' => [
                'slug' => 'posts-test',
                'title' => 'Foo Bar Baz Bat',
            ],
        ];

        Passport::actingAs($user);

        $this->doUpdate($data)->assertStatus(403);
    }

    /**
     * Test the delete resource route.
     */
    public function testDelete()
    {
        $post = factory(Post::class)->create();

        Passport::actingAs($post->author);

        $this->doDelete($post)->assertDeleted();

        $this->assertDatabaseMissing('posts', ['id' => $post->getKey()]);
    }

    /**
     * @param Post $post
     * @return array
     */
    private function serialize(Post $post)
    {
        $self = "http://localhost/api/v1/posts/{$post->getKey()}";

        return [
            'type' => 'posts',
            'id' => (string) $post->getRouteKey(),
            'attributes' => [
                'title' => $post->title,
                'slug' => $post->slug,
                'content' => $post->content,
                'published-at' => $post->published_at->toAtomString(),
            ],
            'relationships' => [
                'author' => [
                    'links' => [
                        'self' => "{$self}/relationships/author",
                        'related' => "{$self}/author",
                    ],
                ],
                'comments' => [
                    'links' => [
                        'self' => "{$self}/relationships/comments",
                        'related' => "{$self}/comments",
                    ],
                ],
                'tags' => [
                    'links' => [
                        'self' => "{$self}/relationships/tags",
                        'related' => "{$self}/tags",
                    ],
                ],
            ],
            'links' => [
                'self' => $self,
            ],
        ];
    }
}
