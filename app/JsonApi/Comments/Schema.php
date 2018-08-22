<?php

namespace App\JsonApi\Comments;

use App\Comment;
use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'comments';

    /**
     * @param Comment $resource
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param Comment $resource
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'created-at' => $resource->created_at->toAtomString(),
            'updated-at' => $resource->updated_at->toAtomString(),
            'content' => $resource->content,
        ];
    }

    /**
     * @param Comment $resource
     * @param bool $isPrimary
     * @param array $includedRelationships
     * @return array
     */
    public function getRelationships($resource, $isPrimary, array $includedRelationships)
    {
        return [
            'post' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::SHOW_DATA => isset($includedRelationships['post']),
                self::DATA => function () use ($resource) {
                    return $resource->post;
                },
            ],
            'created-by' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::SHOW_DATA => isset($includedRelationships['created-by']),
                self::DATA => function () use ($resource) {
                    return $resource->user;
                },
            ],
        ];
    }

}
