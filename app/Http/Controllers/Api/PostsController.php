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
     */
    public function __construct(
        Post $post,
        Posts\Request $request,
        Posts\Hydrator $hydrator
    ) {
        parent::__construct($post, $request, $hydrator);
    }
}
