<?php

namespace App\JsonApi\Posts;

use App\Post;
use CloudCreativity\JsonApi\Exceptions\SchemaException;
use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    const RESOURCE_TYPE = 'posts';

    /**
     * @var array
     */
    protected $attributes = [
        'title',
        'slug',
        'content',
    ];

    /**
     * @return string
     */
    public function getResourceType()
    {
        return self::RESOURCE_TYPE;
    }

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
            'author' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::DATA => isset($includeRelationships['author']) ?
                    $resource->author : $this->createBelongsToIdentity($resource, 'author'),
            ],
            'comments' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::DATA => $resource->comments,
            ],
        ];
    }
}
