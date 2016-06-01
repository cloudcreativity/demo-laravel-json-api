<?php

namespace App\Http\Controllers\Api;

use App\JsonApi\People;
use App\Person;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;

final class PeopleController extends EloquentController
{

    /**
     * PeopleController constructor.
     * @param Person $model
     * @param People\Request $request
     * @param People\Hydrator $hydrator
     */
    public function __construct(
        Person $model,
        People\Request $request,
        People\Hydrator $hydrator
    ) {
        parent::__construct($model, $request, $hydrator);
    }

}
