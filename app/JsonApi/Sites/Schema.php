<?php

namespace App\JsonApi\Sites;

use App\Site;
use CloudCreativity\LaravelJsonApi\Schema\AbstractSchema;
use InvalidArgumentException;

class Schema extends AbstractSchema
{

    /**
     * @var string
     */
    const RESOURCE_TYPE = 'sites';

    /**
     * @return string
     */
    public function getResourceType()
    {
        return self::RESOURCE_TYPE;
    }

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

    /**
     * @param object $resource
     * @return mixed
     */
    public function getAttributes($resource)
    {
        if (!$resource instanceof Site) {
            throw new InvalidArgumentException('Expecting a site object.');
        }

        return $resource->toArray();
    }
}

