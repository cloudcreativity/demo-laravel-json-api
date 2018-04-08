<?php

namespace App\JsonApi\Posts;

use App\Post;
use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use CloudCreativity\LaravelJsonApi\Eloquent\BelongsTo;
use CloudCreativity\LaravelJsonApi\Eloquent\HasMany;
use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use Illuminate\Support\Collection;

class Adapter extends AbstractAdapter
{

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var array
     */
    protected $relationships = [
        'author',
        'tags',
    ];

    /**
     * @var array
     */
    protected $defaultPagination = [
        'number' => 1,
    ];

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
     * @return BelongsTo
     */
    protected function author()
    {
        return $this->belongsTo();
    }

    /**
     * @return HasMany
     */
    protected function tags()
    {
        return $this->hasMany();
    }

    /**
     * @inheritdoc
     */
    protected function filter($query, Collection $filters)
    {
        if ($filters->has('title')) {
            $query->where('posts.title', 'like', '%' . $filters->get('title') . '%');
        }

        if ($filters->has('slug')) {
            $query->where('posts.slug', $filters->get('slug'));
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
