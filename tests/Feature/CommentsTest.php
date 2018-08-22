<?php

namespace Tests\Feature;

use App\Comment;

class CommentsTest extends TestCase
{

    /**
     * @var string
     */
    protected $resourceType = 'comments';

    public function testRead()
    {
        $model = factory(Comment::class)->create();

        $self = "http://localhost/api/v1/comments/{$model->getKey()}";

        $data = [
            'type' => 'comments',
            'id' => (string) $model->getRouteKey(),
            'attributes' => [
                'content' => $model->content,
            ],
            'relationships' => [
                'post' => [
                    'links' => [
                        'self' => "$self/relationships/post",
                        'related' => "$self/post",
                    ],
                ],
                'created-by' => [
                    'links' => [
                        'self' => "$self/relationships/created-by",
                        'related' => "$self/created-by",
                    ],
                ],
            ],
        ];

        $this->doRead($model)->assertRead($data);
    }

}
