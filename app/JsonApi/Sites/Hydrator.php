<?php

namespace App\JsonApi\Sites;

use App\JsonApi\EntityHydrator;

class Hydrator extends EntityHydrator
{

    /**
     * @var array
     */
    protected $attributes = [
        'domain',
        'name',
    ];

}
