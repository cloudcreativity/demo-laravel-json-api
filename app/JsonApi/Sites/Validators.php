<?php

namespace App\JsonApi\Sites;

use CloudCreativity\JsonApi\Contracts\Validators\RelationshipsValidatorInterface;
use CloudCreativity\LaravelJsonApi\Validators\AbstractValidatorProvider;

class Validators extends AbstractValidatorProvider
{

    /**
     * @var array
     */
    protected $allowedFilteringParameters = [
        'id',
    ];

    /**
     * Get the validation rules for the resource attributes.
     *
     * @param string $resourceType
     *      the resource type being validated
     * @param object|null $record
     *      the record being updated, or null if it is a create request.
     * @return array
     */
    protected function attributeRules($resourceType, $record = null)
    {
        $required = $record ? 'sometimes|required' : 'required';

        return [
            'domain' => "$required|url",
            'name' => "$required|string|min:1",
        ];
    }

    /**
     * Define the validation rules for the resource relationships.
     *
     * @param RelationshipsValidatorInterface $relationships
     * @param string $resourceType
     *      the resource type being validated
     * @param object|null $record
     *      the record being updated, or null if it is a create request.
     * @return void
     */
    protected function relationshipRules(RelationshipsValidatorInterface $relationships, $resourceType, $record = null)
    {
        //
    }

}

