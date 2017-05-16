<?php

namespace App\JsonApi\Sites;

use App\JsonApi\EntitySchema;
use App\Site;
use InvalidArgumentException;

class Schema extends EntitySchema
{

    /**
     * @var string
     */
    protected $resourceType = 'sites';

    /**
     * @var array
     */
    protected $attributes = [
        'domain',
        'name',
    ];

    /**
     * @param object $resource
     * @return mixed
     */
    public function getId($resource)
    {
        if (!$resource instanceof Site) {
            throw new InvalidArgumentException('Expecting a site object.');
        }

        return $resource->getSlug();
    }

}

