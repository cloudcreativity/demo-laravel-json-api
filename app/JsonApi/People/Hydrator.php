<?php

namespace App\JsonApi\People;

use App\Person;
use CloudCreativity\JsonApi\Contracts\Object\StandardObjectInterface;
use CloudCreativity\LaravelJsonApi\Hydrator\AbstractHydrator;

class Hydrator extends AbstractHydrator
{

    /**
     * @param StandardObjectInterface $attributes
     * @param Person $record
     */
    protected function hydrateAttributes(StandardObjectInterface $attributes, $record)
    {
        $data = $attributes
            ->getMany([
                'first_name',
                'surname',
            ]);

        $record->fill($data);
    }

}
