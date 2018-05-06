<?php

namespace App\JsonApi\Tags;

use CloudCreativity\LaravelJsonApi\Eloquent\AbstractSchema;

class Schema extends AbstractSchema
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

}
