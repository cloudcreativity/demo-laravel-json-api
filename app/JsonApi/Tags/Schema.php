<?php

namespace App\JsonApi\Tags;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

final class Schema extends EloquentSchema
{

    const RESOURCE_TYPE = 'tags';

    /**
     * @var array
     */
    protected $attributes = [
        'name',
    ];

    /**
     * @return string
     */
    public function getResourceType()
    {
        return self::RESOURCE_TYPE;
    }
}
