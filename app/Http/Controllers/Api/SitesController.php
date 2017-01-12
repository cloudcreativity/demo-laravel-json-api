<?php

namespace App\Http\Controllers\Api;

use App\JsonApi\Sites;
use App\Site;
use App\SiteRepository;
use CloudCreativity\JsonApi\Contracts\Http\Requests\RequestInterface as JsonApiRequest;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;

class SitesController extends JsonApiController
{

    /**
     * @var Sites\Hydrator
     */
    private $hydrator;

    /**
     * SitesController constructor.
     *
     * @param Sites\Hydrator $hydrator
     */
    public function __construct(Sites\Hydrator $hydrator)
    {
        parent::__construct();
        $this->hydrator = $hydrator;
    }

    /**
     * @return string
     */
    protected function getRequestHandler()
    {
        return Sites\Request::class;
    }

    /**
     * @param JsonApiRequest $request
     * @return mixed
     */
    public function index(JsonApiRequest $request)
    {
        /** @var SiteRepository $repository */
        $repository = app(SiteRepository::class);

        return $this
            ->reply()
            ->content($repository->all());
    }

    /**
     * @param JsonApiRequest $request
     * @return mixed
     */
    public function create(JsonApiRequest $request)
    {
        $resource = $request->getDocument()->getResource();
        $record = new Site($resource->getId()); // client generated id.
        $this->hydrator->hydrate($request->getDocument()->getResource(), $record);
        $record->save();

        return $this->reply()->created($record);
    }

    /**
     * @param JsonApiRequest $request
     * @return mixed
     */
    public function read(JsonApiRequest $request)
    {
        return $this->reply()->content($request->getRecord());
    }

    /**
     * @param JsonApiRequest $request
     * @return mixed
     */
    public function update(JsonApiRequest $request)
    {
        /** @var Site $record */
        $record = $request->getRecord();
        $resource = $request->getDocument()->getResource();
        $this->hydrator->hydrate($resource, $record);
        $record->save();

        return $this->reply()->content($record);
    }

    /**
     * @param JsonApiRequest $request
     * @return mixed
     */
    public function delete(JsonApiRequest $request)
    {
        /** @var Site $record */
        $record = $request->getRecord();
        $record->delete();

        return $this->reply()->noContent();
    }
}
