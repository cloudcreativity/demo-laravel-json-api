<?php

namespace App\JsonApi;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Neomerx\JsonApi\Schema\SchemaProvider;
use CloudCreativity\JsonApi\Exceptions\SchemaException;

class ModelSchema extends SchemaProvider
{

    /**
     * @param object $resource
     * @return mixed
     */
    public function getId($resource)
    {
        if (!$resource instanceof Model) {
            throw new SchemaException('Expecting an Eloquent model.');
        }

        return $resource->getKey();
    }

    /**
     * @param object $resource
     * @return array
     */
    public function getAttributes($resource)
    {
        if (!$resource instanceof Model) {
            throw new SchemaException('Expecting an Eloquent model.');
        }

        return [
            'created-at' => $this->serializeDate($resource->{$resource->getCreatedAtColumn()}),
            'updated-at' => $this->serializeDate($resource->{$resource->getUpdatedAtColumn()}),
        ];
    }

    /**
     * @param Carbon|null $date
     * @return null|string
     */
    protected function serializeDate(Carbon $date = null)
    {
        return $date ? $date->toW3cString() : null;
    }
}
