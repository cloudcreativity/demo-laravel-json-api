<?php

namespace App\JsonApi\Posts;

use App\Post;
use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use CloudCreativity\LaravelJsonApi\Store\EloquentAdapter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Adapter extends EloquentAdapter
{

    /**
     * Adapter constructor.
     *
     * @param StandardStrategy $paging
     */
    public function __construct(StandardStrategy $paging)
    {
        parent::__construct(new Post(), $paging);
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
     */
    protected function isSearchOne(Collection $filters)
    {
        return $filters->has('slug');
    }
}
