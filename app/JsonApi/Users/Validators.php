<?php

namespace App\JsonApi\Users;

use CloudCreativity\LaravelJsonApi\Validation\AbstractValidators;

class Validators extends AbstractValidators
{

    /**
     * Get the validation rules for the resource.
     *
     * @param $record
     *      the record being updated, or null if it is a create request.
     * @return array
     */
    protected function rules($record = null): array
    {
        return [
            //
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
