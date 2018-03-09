<?php

namespace App\JsonApi\Posts;

use CloudCreativity\LaravelJsonApi\Hydrator\EloquentHydrator;

class Hydrator extends EloquentHydrator
{

    /**
     * @var array
     */
    protected $attributes = [
        'title',
        'slug',
        'content',
        'published-at',
    ];

    /**
     * @var array
     */
    protected $relationships = [
        'author',
        'tags',
    ];

}
