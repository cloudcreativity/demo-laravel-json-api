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
        $model = $this->model();

        $data = [
            'type' => 'comments',
            'id' => (string) $model->getKey(),
            'attributes' => [
                'content' => $model->content,
            ],
            'relationships' => [
                'post' => [
                    'data' => [
                        'type' => 'posts',
                        'id' => $model->post_id,
                    ],
                ],
                'created-by' => [
                    'data' => [
                        'type' => 'people',
                        'id' => $model->person_id,
                    ],
                ],
            ],
        ];

        $this->doRead($model)->assertReadResponse($data);
    }

    /**
     * @param bool $create
     * @return Comment
     */
    private function model($create = true)
    {
        $factory = factory(Comment::class);

        return $create ? $factory->create() : $factory->make();
    }
}
