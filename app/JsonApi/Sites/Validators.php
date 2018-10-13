<?php

namespace App\JsonApi\Sites;

use CloudCreativity\LaravelJsonApi\Validation\AbstractValidators;

class Validators extends AbstractValidators
{

    /**
     * @var array
     */
    protected $allowedFilteringParameters = [
        'id',
    ];

    /**
     * @inheritdoc
     */
    protected function rules($record = null): array
    {
        return [
            'domain' => "required|url",
            'name' => "required|string|min:1",
        ];
    }

    /**
     * @return array
     */
    protected function queryRules(): array
    {
        return [];
    }

}

