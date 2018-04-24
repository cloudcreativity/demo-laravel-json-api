<?php

namespace App\Http\Controllers\Api;

use App\Events\PostCreated;
use App\Post;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;

class PostsController extends JsonApiController
{

    /**
     * @param Post $post
     * @return void
     */
    public function created(Post $post)
    {
        event(new PostCreated($post));
    }
}
