<?php

namespace App\JsonApi\Tokens;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'tokens';

    /**
     * @var array|null
     */
    protected $attributes = null;

}

