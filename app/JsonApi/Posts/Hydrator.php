<?php

namespace App\JsonApi\Posts;

use App\Person;
use App\Post;
use CloudCreativity\JsonApi\Contracts\Object\RelationshipInterface;
use CloudCreativity\JsonApi\Contracts\Object\StandardObjectInterface;
use CloudCreativity\JsonApi\Exceptions\HydratorException;
use CloudCreativity\JsonApi\Hydrator\AbstractHydrator;

class Hydrator extends AbstractHydrator
{

    /**
     * @param StandardObjectInterface $attributes
     * @param $record
     */
    protected function hydrateAttributes(StandardObjectInterface $attributes, $record)
    {
        if (!$record instanceof Post) {
            throw new HydratorException('Expecting a post model.');
        }

        $data = $attributes->getMany([
            'title',
            'slug',
            'content',
        ]);

        $record->fill($data);
    }

    /**
     * @param RelationshipInterface $relationship
     * @param Post $model
     */
    protected function hydrateAuthorRelationship(RelationshipInterface $relationship, Post $model)
    {
        /** @var Person|null $author */
        $author = Person::find($relationship->getIdentifier()->getId());
        $model->author()->associate($author);
    }
}
