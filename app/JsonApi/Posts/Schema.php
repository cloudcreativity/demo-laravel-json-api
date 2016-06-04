<?php

namespace App\JsonApi\Posts;

use App\Post;
use CloudCreativity\JsonApi\Exceptions\SchemaException;
use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'posts';

    /**
     * @var array
     */
    protected $attributes = [
        'title',
        'slug',
        'content',
    ];

    /**
     * @param object $resource
     * @param bool $isPrimary
     * @param array $includeRelationships
     * @return array
     */
    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        if (!$resource instanceof Post) {
            throw new SchemaException('Expecting a post model.');
        }

        return [
            'author' => $this->serializeBelongsTo(
                $resource,
                'author',
                isset($includeRelationships['author']),
                'people'
            ),
            'comments' => $this->serializeRelationship($resource, 'comments'),
        ];
    }
}
