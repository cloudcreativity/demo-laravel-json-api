<?php

namespace App\JsonApi\Comments;

use App\Comment;
use CloudCreativity\JsonApi\Exceptions\SchemaException;
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
            throw new SchemaException('Expecting a comment model.');
        }

        return [
            'post' => $this->serializeBelongsTo(
                $resource,
                'post',
                isset($includeRelationships['post'])
            ),
            'created-by' => $this->serializeBelongsTo(
                $resource,
                'person',
                isset($includeRelationships['created-by']),
                'people'
            ),
        ];
    }
}
