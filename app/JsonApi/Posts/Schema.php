<?php

namespace App\JsonApi\Posts;

use App\Post;
use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
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
     * @var array
     */
    protected $relationships = [
        'author',
        'comments',
        'tags',
    ];

    /**
     * @param Post $resource
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param Post $resource
     * @return array
     */
    public function getAttributes($resource)
    {
        $publishedAt = $resource->published_at;

        return [
            'created-at' => $resource->created_at->toAtomString(),
            'updated-at' => $resource->updated_at->toAtomString(),
            'title' => $resource->title,
            'slug' => $resource->slug,
            'content' => $resource->content,
            'published-at' => $publishedAt ? $publishedAt->toAtomString() : null,
        ];
    }

    /**
     * @param Post $resource
     * @param bool $isPrimary
     * @param array $includedRelationships
     * @return array
     */
    public function getRelationships($resource, $isPrimary, array $includedRelationships)
    {
        return [
            'author' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::SHOW_DATA => isset($includedRelationships['author']),
                self::DATA => function () use ($resource) {
                    return $resource->author;
                },
            ],
            'comments' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::SHOW_DATA => false,
            ],
            'tags' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::SHOW_DATA => isset($includedRelationships['tags']),
                self::DATA => function () use ($resource) {
                    return $resource->tags;
                },
            ],
        ];
    }

}
