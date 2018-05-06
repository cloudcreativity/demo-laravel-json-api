<?php

namespace App\JsonApi\People;

use App\Person;
use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use Illuminate\Support\Collection;

class Adapter extends AbstractAdapter
{

    /**
     * @var array
     */
    protected $attributes = [
        'first-name',
        'surname',
    ];

    /**
     * Adapter constructor.
     */
    public function __construct()
    {
        parent::__construct(new Person());
    }

    /**
     * @inheritDoc
     */
    protected function filter($query, Collection $filters)
    {
        // TODO: Implement filter() method.
    }

    /**
     * @inheritDoc
     */
    protected function isSearchOne(Collection $filters)
    {
        // TODO: Implement isSearchOne() method.
    }


}
