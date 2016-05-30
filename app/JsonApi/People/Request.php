<?php

namespace App\JsonApi\People;

use CloudCreativity\LaravelJsonApi\Http\Requests\AbstractRequest;

class Request extends AbstractRequest
{

    /**
     * @return string
     */
    public function resourceType()
    {
        return 'people';
    }

}
