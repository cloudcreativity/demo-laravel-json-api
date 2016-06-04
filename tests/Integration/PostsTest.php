<?php

namespace App\Tests\Integration;

use App\Post;

class PostsTest extends TestCase
{

    /**
     * Test the index (read many) route.
     */
    public function testIndex()
    {
        $uri = $this->linkTo()->index('api-v1::posts');

        $this->jsonApi('GET', $uri)
            ->assertIndexResponse('posts');
    }

    /**
     * Test the create resource route.
     */
    public function testCreate()
    {
        /** @var Post $model */
        $model = factory(Post::class)->make();
        $uri = $this->linkTo()->index('api-v1::posts');

        $data = [
            'type' => 'posts',
            'attributes' => [
                'title' => $model->title,
                'slug' => $model->slug,
                'content' => $model->content,
            ],
            'relationships' => [
                'author' => [
                    'data' => [
                        'type' => 'people',
                        'id' => $model->author_id,
                    ],
                ],
            ],
        ];

        $id = $this
            ->jsonApi('POST', $uri, ['data' => $data])
            ->assertCreateResponse($data);

        $this->assertModelCreated($model, $id, ['title', 'slug', 'content', 'author_id']);
    }

    /**
     * Test the read resource route.
     */
    public function testRead()
    {
        /** @var Post $model */
        $model = factory(Post::class)->create();
        $uri = $this->linkTo()->resource('api-v1::posts', $model->getKey());

        $data = [
            'type' => 'posts',
            'id' => $model->getKey(),
            'attributes' => [
                'title' => $model->title,
                'slug' => $model->slug,
                'content' => $model->content,
            ],
            'relationships' => [
                'author' => [
                    'data' => [
                        'type' => 'people',
                        'id' => $model->author_id,
                    ],
                ],
            ],
        ];

        $this->jsonApi('GET', $uri)
            ->assertReadResponse($data);
    }

    /**
     * Test the update resource route.
     */
    public function testUpdate()
    {
        /** @var Post $model */
        $model = factory(Post::class)->create();
        $uri = $this->linkTo()->resource('api-v1::posts', $model->getKey());
        $slug = 'foo-bar-baz-bat';
        $title = 'Foo Bar Baz Bat';

        $data = [
            'type' => 'posts',
            'id' => $model->getKey(),
            'attributes' => [
                'slug' => $slug,
                'title' => $title,
            ],
        ];

        $this->jsonApi('PATCH', $uri, ['data' => $data])
            ->assertUpdateResponse($data)
            ->assertModelPatched($model, $data['attributes'], ['content']);
    }

    /**
     * Test the delete resource route.
     */
    public function testDelete()
    {
        /** @var Post $model */
        $model = factory(Post::class)->create();
        $uri = $this->linkTo()->resource('api-v1::posts', $model->getKey());

        $this->jsonApi('DELETE', $uri)
            ->assertDeleteResponse()
            ->assertModelDeleted($model);
    }
}
