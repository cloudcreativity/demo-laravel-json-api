<?php

namespace App\JsonApi\People;

use App\Person;
use CloudCreativity\JsonApi\Exceptions\RuntimeException;
use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'people';

    /**
     * @var array
     */
    protected $attributes = [
        'first_name',
        'surname',
    ];

    /**
     * @param object $resource
     * @param bool $isPrimary
     * @param array $includeRelationships
     * @return array
     */
    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        if (!$resource instanceof Person) {
            throw new RuntimeException('Expecting a person model.');
        }

        return [
            'comments' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::META => function () use ($resource) {
                    return ['total' => $resource->comments()->count()];
                },
            ],
            'posts' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::META => function () use ($resource) {
                    ['total' => $resource->posts()->count()];
                },
            ],
        ];
    }
}
