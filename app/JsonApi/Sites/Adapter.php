<?php

namespace App\JsonApi\Sites;

use App\Site;
use App\SiteRepository;
use CloudCreativity\LaravelJsonApi\Adapter\AbstractResourceAdapter;
use CloudCreativity\LaravelJsonApi\Document\ResourceObject;
use CloudCreativity\LaravelJsonApi\Utils\Str;
use Illuminate\Support\Collection;
use Neomerx\JsonApi\Contracts\Encoder\Parameters\EncodingParametersInterface;

class Adapter extends AbstractResourceAdapter
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
     * @return bool
     */
    public function destroy($record)
    {
        $record->delete();

        return true;
    }

    /**
     * @inheritdoc
     */
    protected function createRecord(ResourceObject $resource)
    {
        return new Site($resource['id']); // client generated id.
    }

    /**
     * @param Site $record
     * @param Collection $attributes
     */
    protected function fillAttributes($record, Collection $attributes)
    {
        $attributes->only(['name', 'domain'])->each(function ($value, $key) use ($record) {
            $this->fillAttribute($record, $key, $value);
        });
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
     * @param Site $record
     * @param string $attrKey
     * @param mixed $value
     * @return void
     */
    protected function fillAttribute(Site $record, string $attrKey, $value): void
    {
        $method = 'set' . Str::classify($attrKey);

        call_user_func([$record, $method], $value);
    }

}
