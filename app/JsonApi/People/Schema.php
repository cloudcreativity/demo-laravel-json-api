<?php

namespace App\JsonApi\People;

use App\JsonApi\ModelSchema;
use App\Person;
use CloudCreativity\JsonApi\Exceptions\SchemaException;

class Schema extends ModelSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'people';

    /**
     * @param object $resource
     * @return mixed
     */
    public function getAttributes($resource)
    {
        if (!$resource instanceof Person) {
            throw new SchemaException('Expecting a person model.');
        }

        return array_merge(parent::getAttributes($resource), [
            'first-name' => $resource->first_name,
            'surname' => $resource->surname,
        ]);
    }
}
