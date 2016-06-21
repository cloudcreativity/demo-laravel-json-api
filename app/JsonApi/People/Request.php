<?php

namespace App\JsonApi\People;

use CloudCreativity\LaravelJsonApi\Http\Requests\AbstractRequest;

class Request extends AbstractRequest
{

    /**
     * @var string
     */
    protected $resourceType = Schema::RESOURCE_TYPE;

}
