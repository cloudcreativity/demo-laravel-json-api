<?php

namespace App\Http\Controllers\Api;

use App\JsonApi\Posts;
use App\Post;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;

class PostsController extends EloquentController
{

    /**
     * PostsController constructor.
     *
     * @param Posts\Hydrator $hydrator
     */
    public function __construct(Posts\Hydrator $hydrator)
    {
        parent::__construct(new Post(), $hydrator);
    }

}
