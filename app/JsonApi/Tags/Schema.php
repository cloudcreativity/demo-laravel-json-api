<?php

namespace App\JsonApi\Tags;

use App\Tag;
use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'tags';

    /**
     * @var array
     */
    protected $attributes = [
        'name',
    ];

    /**
     * @param Tag $resource
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param Tag $resource
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'created-at' => $resource->created_at->toAtomString(),
            'updated-at' => $resource->updated_at->toAtomString(),
            'name' => $resource->name,
        ];
    }
}
