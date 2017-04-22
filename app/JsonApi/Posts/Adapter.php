<?php

namespace App\JsonApi\Posts;

use App\Post;
use CloudCreativity\LaravelJsonApi\Store\EloquentAdapter;

class Adapter extends EloquentAdapter
{

    /**
     * Adapter constructor.
     */
    public function __construct()
    {
        parent::__construct(new Post());
    }
}
