<?php

namespace App\Http\Controllers\Api;

use App\JsonApi\People;
use App\Person;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;

final class PeopleController extends EloquentController
{

    /**
     * PeopleController constructor.
     * @param People\Request $request
     * @param People\Hydrator $hydrator
     */
    public function __construct(
        People\Request $request,
        People\Hydrator $hydrator
    ) {
        parent::__construct(new Person(), $request, $hydrator);
    }

}
