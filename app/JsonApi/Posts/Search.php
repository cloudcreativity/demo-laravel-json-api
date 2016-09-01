<?php

namespace App\JsonApi\Posts;

use CloudCreativity\LaravelJsonApi\Search\AbstractSearch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Search extends AbstractSearch
{

    /**
     * @var int
     */
    protected $maxPerPage = 25;

    /**
     * @param Builder $builder
     * @param Collection $filters
     */
    protected function filter(Builder $builder, Collection $filters)
    {
        if ($filters->has('title')) {
            $builder->where('posts.title', 'like', '%' . $filters->get('title') . '%');
        }

        if ($filters->has('slug')) {
            $builder->where('posts.slug', $filters->get('slug'));
        }
    }

    /**
     * @param Collection $filters
     * @return bool
     */
    protected function isSearchOne(Collection $filters)
    {
        return $filters->has('slug');
    }

}
