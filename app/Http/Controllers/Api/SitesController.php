<?php

namespace App\Http\Controllers\Api;

use App\JsonApi\Sites\Hydrator;
use App\Site;
use CloudCreativity\JsonApi\Contracts\Http\Requests\RequestInterface;
use CloudCreativity\JsonApi\Contracts\Object\ResourceObjectInterface;
use CloudCreativity\JsonApi\Contracts\Store\StoreInterface;
use CloudCreativity\LaravelJsonApi\Http\Controllers\CreatesResponses;
use Illuminate\Routing\Controller;

class SitesController extends Controller
{

    use CreatesResponses;

    /**
     * @param StoreInterface $store
     * @param RequestInterface $request
     * @return mixed
     */
    public function index(StoreInterface $store, RequestInterface $request)
    {
        $results = $store->query(
            $request->getResourceType(),
            $request->getParameters()
        );

        return $this->reply()->content($results);
    }

    /**
     * @param Hydrator $hydrator
     * @param ResourceObjectInterface $resource
     * @return mixed
     */
    public function create(Hydrator $hydrator, ResourceObjectInterface $resource)
    {
        $record = new Site($resource->getId()); // client generated id.
        $hydrator->hydrate($resource, $record);
        $record->save();

        return $this->reply()->created($record);
    }

    /**
     * @param Site $record
     * @return mixed
     */
    public function read(Site $record)
    {
        return $this->reply()->content($record);
    }

    /**
     * @param Hydrator $hydrator
     * @param ResourceObjectInterface $resource
     * @param Site $record
     * @return mixed
     */
    public function update(Hydrator $hydrator, ResourceObjectInterface $resource, Site $record)
    {
        $hydrator->hydrate($resource, $record);
        $record->save();

        return $this->reply()->content($record);
    }

    /**
     * @param Site $record
     * @return mixed
     */
    public function delete(Site $record)
    {
        $record->delete();

        return $this->reply()->noContent();
    }
}
