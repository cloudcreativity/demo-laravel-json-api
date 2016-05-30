<?php

namespace App\Http\Controllers\Api;

use App\Person;
use App\JsonApi\People;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;
use CloudCreativity\LaravelJsonApi\Http\Requests\AbstractRequest;
use Illuminate\Http\Response;

final class PeopleController extends JsonApiController
{

    /**
     * PeopleController constructor.
     * @param People\Request $request
     */
    public function __construct(People\Request $request)
    {
        parent::__construct($request);
    }

    /**
     * @return Response
     */
    public function index()
    {
        $models = Person::all();

        return $this
            ->reply()
            ->content($models);
    }

    /**
     * @param $resourceId
     * @return Response
     */
    public function read($resourceId)
    {
        /** @var AbstractRequest $request */
        $request = $this->request();

        return $this
            ->reply()
            ->content($request->record());
    }
}
