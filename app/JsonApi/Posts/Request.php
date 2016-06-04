<?php

namespace App\JsonApi\Posts;

use CloudCreativity\LaravelJsonApi\Http\Requests\AbstractRequest;

class Request extends AbstractRequest
{

    /**
     * @return string
     */
    public function resourceType()
    {
        return 'posts';
    }
}
