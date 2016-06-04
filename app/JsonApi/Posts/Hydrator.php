<?php

namespace App\JsonApi\Posts;

use App\Person;
use App\Post;
use CloudCreativity\JsonApi\Contracts\Object\RelationshipInterface;
use CloudCreativity\JsonApi\Contracts\Object\StandardObjectInterface;
use CloudCreativity\JsonApi\Exceptions\HydratorException;
use CloudCreativity\LaravelJsonApi\Hydrator\AbstractHydrator;

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
        if (!$relationship->isHasOne()) {
            throw new HydratorException('Expecting a has-one author relationship.');
        }

        /** @var Person|null $author */
        $author = Person::find($relationship->data()->id());

        if (!$author) {
            throw new HydratorException('Expecting a valid author relationship.');
        }

        $model->author()->associate($author);
    }
}
