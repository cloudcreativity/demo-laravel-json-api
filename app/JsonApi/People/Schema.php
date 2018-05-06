<?php

namespace App\JsonApi\People;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'people';

    /**
     * @var array
     */
    protected $attributes = [
        'first_name',
        'surname',
    ];

    /**
     * @var array
     */
    protected $relationships = [
        'comments',
        'posts',
    ];

}
