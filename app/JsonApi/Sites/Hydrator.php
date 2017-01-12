<?php

namespace App\JsonApi\Sites;

use App\Site;
use CloudCreativity\JsonApi\Contracts\Hydrator\HydratesRelatedInterface;
use CloudCreativity\JsonApi\Contracts\Object\ResourceInterface;
use CloudCreativity\JsonApi\Contracts\Object\StandardObjectInterface;
use CloudCreativity\JsonApi\Hydrator\AbstractHydrator;
use CloudCreativity\JsonApi\Hydrator\RelatedHydratorTrait;

class Hydrator extends AbstractHydrator implements HydratesRelatedInterface
{

    use RelatedHydratorTrait;

    /**
     * @param StandardObjectInterface $attributes
     * @param Site $record
     * @return void
     */
    protected function hydrateAttributes(StandardObjectInterface $attributes, $record)
    {
        // This is intended as an example. As the hydration logic is incredibly simple,
        // it might be preferrable to do this in the controller rather than having a
        // hydrator class. Hydrator classes are most useful when hydration logic is
        // complex, or can by abstracted across many record classes.
        $data = $attributes->getMany(['domain', 'name']);
        $record->exchangeArray($data);
    }

    /**
     * @param ResourceInterface $resource
     * @param object $record
     * @return mixed
     */
    public function hydrateRelated(ResourceInterface $resource, $record)
    {
        // no-op
    }


}
