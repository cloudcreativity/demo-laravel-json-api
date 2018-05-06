<?php

namespace App\JsonApi\Tags;

use App\Tag;
use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use Illuminate\Support\Collection;

class Adapter extends AbstractAdapter
{

    /**
     * Adapter constructor.
     */
    public function __construct()
    {
        parent::__construct(new Tag());
    }

    /**
     * @inheritDoc
     */
    protected function filter($query, Collection $filters)
    {
        // TODO: Implement filter() method.
    }

}
