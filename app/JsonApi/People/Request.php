<?php

namespace App\JsonApi\People;

use CloudCreativity\LaravelJsonApi\Http\Requests\AbstractRequest;
use CloudCreativity\LaravelJsonApi\Http\Requests\ForbidsRequests;

class Request extends AbstractRequest
{

    use ForbidsRequests;

    /**
     * @return string
     */
    public function getResourceType()
    {
        return 'people';
    }

}
