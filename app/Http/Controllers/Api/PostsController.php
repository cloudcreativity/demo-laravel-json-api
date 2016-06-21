<?php

namespace App\Http\Controllers\Api;

use App\JsonApi\Posts;
use App\Post;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;

class PostsController extends EloquentController
{

    /**
     * PostsController constructor.
     * @param Posts\Request $request
     * @param Posts\Hydrator $hydrator
     * @param Posts\Search $search
     */
    public function __construct(
        Posts\Request $request,
        Posts\Hydrator $hydrator,
        Posts\Search $search
    ) {
        parent::__construct(new Post(), $request, $hydrator, $search);
    }
}
