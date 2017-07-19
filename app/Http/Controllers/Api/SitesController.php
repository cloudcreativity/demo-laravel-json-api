<?php

namespace App\Http\Controllers\Api;

use App\JsonApi\Sites;
use App\Site;
use CloudCreativity\JsonApi\Contracts\Http\Requests\RequestInterface;
use CloudCreativity\JsonApi\Contracts\Object\ResourceObjectInterface;
use CloudCreativity\LaravelJsonApi\Http\Controllers\CreatesResponses;
use Illuminate\Routing\Controller;

class SitesController extends Controller
{

    use CreatesResponses;

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
        $this->hydrator = $hydrator;
    }

    /**
     * @param RequestInterface $request
     * @return mixed
     */
    public function index(RequestInterface $request)
    {
        $results = $this->api()->getStore()->query(
            $request->getResourceType(),
            $request->getParameters()
        );

        return $this->reply()->content($results);
    }

    /**
     * @param ResourceObjectInterface $resource
     * @return mixed
     */
    public function create(ResourceObjectInterface $resource)
    {
        $record = new Site($resource->getId()); // client generated id.
        $this->hydrator->hydrate($resource, $record);
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
     * @param ResourceObjectInterface $resource
     * @param Site $record
     * @return mixed
     */
    public function update(ResourceObjectInterface $resource, Site $record)
    {
        $this->hydrator->hydrate($resource, $record);
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
