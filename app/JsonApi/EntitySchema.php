<?php

namespace App\JsonApi;

use CloudCreativity\JsonApi\Schema\ExtractsAttributesTrait;
use CloudCreativity\JsonApi\Utils\Str;
use Neomerx\JsonApi\Schema\SchemaProvider;

/**
 * Class EntitySchema
 *
 * A custom schema for our objects that are not Eloquent models. We've used
 * the `ExtractsAttributeTrait` so that our schema operates in a similar
 * fashion to the `EloquentSchema`.
 *
 * @package App\JsonApi
 */
abstract class EntitySchema extends SchemaProvider
{

    use ExtractsAttributesTrait;

    /**
     * @param $record
     * @param $recordKey
     * @return mixed
     */
    protected function extractAttribute($record, $recordKey)
    {
        $method = 'get' . Str::classify($recordKey);

        return call_user_func([$record, $method]);
    }
}
