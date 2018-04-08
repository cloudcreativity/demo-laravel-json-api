<?php

namespace App\JsonApi\Sites;

use App\Site;
use App\SiteRepository;
use CloudCreativity\LaravelJsonApi\Adapter\AbstractResourceAdapter;
use CloudCreativity\LaravelJsonApi\Adapter\HydratesAttributesTrait;
use CloudCreativity\LaravelJsonApi\Contracts\Object\RelationshipsInterface;
use CloudCreativity\LaravelJsonApi\Contracts\Object\ResourceObjectInterface;
use CloudCreativity\LaravelJsonApi\Utils\Str;
use Neomerx\JsonApi\Contracts\Encoder\Parameters\EncodingParametersInterface;

class Adapter extends AbstractResourceAdapter
{

    use HydratesAttributesTrait;

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
     * @inheritDoc
     */
    public function query(EncodingParametersInterface $parameters)
    {
        return $this->repository->all();
    }

    /**
     * @inheritdoc
     */
    public function exists($resourceId)
    {
        return !is_null($this->find($resourceId));
    }

    /**
     * @inheritdoc
     */
    public function find($resourceId)
    {
        return $this->repository->find($resourceId);
    }

    /**
     * @inheritdoc
     */
    public function findMany(array $resourceIds)
    {
        return collect($resourceIds)->map(function ($resourceId) {
            return $this->find($resourceId);
        })->all();
    }

    /**
     * @param Site $record
     * @param EncodingParametersInterface $params
     * @return bool
     */
    public function delete($record, EncodingParametersInterface $params)
    {
        $record->delete();

        return true;
    }

    /**
     * @inheritdoc
     */
    public function related($relationshipName)
    {
        throw new \LogicException('Not implemented.');
    }

    /**
     * @inheritdoc
     */
    protected function createRecord(ResourceObjectInterface $resource)
    {
        return new Site($resource->getId()); // client generated id.
    }

    /**
     * @inheritdoc
     */
    protected function hydrateRelationships(
        $record,
        RelationshipsInterface $relationships,
        EncodingParametersInterface $parameters
    ) {
        // no-op
    }

    /**
     * @param Site $record
     * @return object
     */
    protected function persist($record)
    {
        $record->save();

        return $record;
    }

    /**
     * @param object $record
     * @param string $attrKey
     * @param mixed $value
     * @return void
     */
    protected function hydrateAttribute($record, $attrKey, $value)
    {
        $method = 'set' . Str::classify($attrKey);

        call_user_func([$record, $method], $value);
    }

}
