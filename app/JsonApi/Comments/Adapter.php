<?php

namespace App\JsonApi\Comments;

use App\Comment;
use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use CloudCreativity\LaravelJsonApi\Eloquent\BelongsTo;
use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Adapter extends AbstractAdapter
{

    /**
     * Adapter constructor.
     *
     * @param StandardStrategy $paging
     */
    public function __construct(StandardStrategy $paging)
    {
        parent::__construct(new Comment(), $paging);
    }

    /**
     * @return BelongsTo
     */
    protected function post()
    {
        return $this->belongsTo();
    }

    /**
     * @return BelongsTo
     */
    protected function createdBy()
    {
        return $this->belongsTo('user');
    }

    /**
     * @inheritDoc
     */
    protected function filter($query, Collection $filters)
    {
        // TODO: Implement filter() method.
    }

    /**
     * @param Comment $comment
     */
    protected function creating(Comment $comment): void
    {
        $comment->user()->associate(Auth::user());
    }

}
