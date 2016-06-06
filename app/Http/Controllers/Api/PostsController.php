<?php

namespace App\Http\Controllers\Api;

use App\JsonApi\Posts;
use App\Post;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;

class PostsController extends EloquentController
{

    /**
     * PostsController constructor.
     * @param Post $post
     * @param Posts\Request $request
     * @param Posts\Hydrator $hydrator
     * @param Posts\Search $search
     */
    public function __construct(
        Post $post,
        Posts\Request $request,
        Posts\Hydrator $hydrator,
        Posts\Search $search
    ) {
        parent::__construct($post, $request, $hydrator, $search);
    }
}
