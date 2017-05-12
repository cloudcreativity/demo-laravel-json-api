<?php

namespace App\JsonApi\People;

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
     * @inheritDoc
     */
    protected function attributeRules($resourceType, $record = null)
    {
        $required = $record ? 'sometimes|required' : 'required';

        return [
            'first-name' => "$required|string|min:1",
            'surname' => "$required|string|min:1",
        ];
    }

    /**
     * @inheritDoc
     */
    protected function relationshipRules(
        RelationshipsValidatorInterface $relationships,
        $resourceType,
        $record = null
    ) {
    }

}
