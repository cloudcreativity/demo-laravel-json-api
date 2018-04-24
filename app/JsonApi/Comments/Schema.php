<?php

namespace App\JsonApi\Comments;

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
     * @var array
     */
    protected $relationships = [
        'post',
        'person' => 'created-by',
    ];

}
