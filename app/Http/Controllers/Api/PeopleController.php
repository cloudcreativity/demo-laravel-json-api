<?php

namespace App\Http\Controllers\Api;

use App\JsonApi\People;
use App\Person;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;
use CloudCreativity\LaravelJsonApi\Search\SearchAll;

final class PeopleController extends EloquentController
{

    /**
     * PeopleController constructor.
     * @param People\Hydrator $hydrator
     * @param SearchAll $search
     */
    public function __construct(People\Hydrator $hydrator, SearchAll $search)
    {
        parent::__construct(new Person(), $hydrator, $search);
    }

    /**
     * @return string
     */
    protected function getRequestHandler()
    {
        return People\Request::class;
    }

}
