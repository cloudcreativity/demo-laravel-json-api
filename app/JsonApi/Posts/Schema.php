<?php

namespace App\JsonApi\Posts;

use App\Post;
use CloudCreativity\LaravelJsonApi\Eloquent\AbstractSchema;
use CloudCreativity\LaravelJsonApi\Exceptions\RuntimeException;

class Schema extends AbstractSchema
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
        'published_at',
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
            throw new RuntimeException('Expecting a post model.');
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
            'tags' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::DATA => function () use ($resource) {
                    return $resource->tags;
                },
            ],
        ];
    }
}
