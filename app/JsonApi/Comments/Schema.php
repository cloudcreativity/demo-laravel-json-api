<?php

namespace App\JsonApi\Comments;

use App\Comment;
use CloudCreativity\LaravelJsonApi\Exceptions\RuntimeException;
use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'comments';

    /**
     * @var array
     */
    protected $attributes = [
        'content'
    ];

    /**
     * @param object $resource
     * @param bool $isPrimary
     * @param array $includeRelationships
     * @return array
     */
    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        if (!$resource instanceof Comment) {
            throw new RuntimeException('Expecting a comment model.');
        }

        return [
            'post' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::DATA => isset($includeRelationships['post']) ?
                    $resource->post : $this->createBelongsToIdentity($resource, 'post'),
            ],
            'created-by' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::DATA => isset($includeRelationships['created-by']) ?
                    $resource->person : $this->createBelongsToIdentity($resource, 'person'),
            ],
        ];
    }
}
