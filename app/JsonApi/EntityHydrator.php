<?php

namespace App\JsonApi;

use CloudCreativity\JsonApi\Hydrator\AbstractHydrator;
use CloudCreativity\JsonApi\Hydrator\HydratesAttributesTrait;
use CloudCreativity\JsonApi\Utils\Str;

/**
 * Class EntityHydrator
 *
 * A custom hydrator for our objects that are not Eloquent models. We've used
 * the `HydratesAttributesTrait` so that our schema operates in a similar
 * fashion to the `EloquentHydrator`.
 *
 * @package App\JsonApi
 */
class EntityHydrator extends AbstractHydrator
{

    use HydratesAttributesTrait;

    /**
     * @param object $record
     * @param string $attrKey
     * @param mixed $value
     * @return void
     */
    protected function hydrateAttribute($record, $attrKey, $value)
    {
        $method = 'set' . Str::classify($attrKey);

        call_user_func([$record, $method], $value);
    }

}
