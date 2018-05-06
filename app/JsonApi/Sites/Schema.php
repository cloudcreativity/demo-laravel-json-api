<?php

namespace App\JsonApi\Sites;

use App\Site;
use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'sites';

    /**
     * @param Site $resource
     * @return string
     */
    public function getId($resource)
    {
        return $resource->getSlug();
    }

    /**
     * @param Site $resource
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'domain' => $resource->getDomain(),
            'name' => $resource->getName(),
        ];
    }

}

