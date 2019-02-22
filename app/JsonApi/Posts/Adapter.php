<?php

namespace App\JsonApi\Posts;

use App\Post;
use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use CloudCreativity\LaravelJsonApi\Eloquent\BelongsTo;
use CloudCreativity\LaravelJsonApi\Eloquent\HasMany;
use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

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
    protected $dates = [
        'published-at',
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
    protected function comments()
    {
        return $this->hasMany();
    }

    /**
     * @return HasMany
     */
    protected function tags()
    {
        return $this->hasMany();
    }

    /**
     * @param Post $post
     */
    protected function creating(Post $post): void
    {
        $post->author()->associate(Auth::user());
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
