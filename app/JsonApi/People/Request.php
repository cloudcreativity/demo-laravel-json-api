<?php

namespace App\JsonApi\People;

use CloudCreativity\LaravelJsonApi\Http\Requests\AbstractRequestHandler;

class Request extends AbstractRequestHandler
{

    /**
     * @var array
     */
    protected $allowedFilteringParameters = [
        'id',
    ];

    /**
     * @return string
     */
    public function getResourceType()
    {
        return Schema::RESOURCE_TYPE;
    }

}
