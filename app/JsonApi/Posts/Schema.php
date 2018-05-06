<?php

namespace App\JsonApi\Posts;

use CloudCreativity\LaravelJsonApi\Eloquent\AbstractSchema;

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
     * @var array
     */
    protected $relationships = [
        'author',
        'comments',
        'tags',
    ];

}
