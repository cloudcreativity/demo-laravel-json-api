<?php

namespace App\JsonApi\Sites;

use App\SiteRepository;
use CloudCreativity\JsonApi\Contracts\Object\ResourceIdentifierInterface;
use CloudCreativity\JsonApi\Contracts\Store\AdapterInterface;

class Adapter implements AdapterInterface
{

    /**
     * @var SiteRepository
     */
    private $repository;

    /**
     * Adapter constructor.
     *
     * @param SiteRepository $repository
     */
    public function __construct(SiteRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $resourceType
     * @return mixed
     */
    public function recognises($resourceType)
    {
        return Schema::RESOURCE_TYPE === $resourceType;
    }

    /**
     * @param ResourceIdentifierInterface $identifier
     * @return mixed
     */
    public function exists(ResourceIdentifierInterface $identifier)
    {
        return !is_null($this->find($identifier));
    }

    /**
     * @param ResourceIdentifierInterface $identifier
     * @return mixed
     */
    public function find(ResourceIdentifierInterface $identifier)
    {
        return $this->repository->find($identifier->getId());
    }

}
