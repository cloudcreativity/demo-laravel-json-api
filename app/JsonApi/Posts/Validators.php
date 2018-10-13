<?php

namespace App\JsonApi\Posts;

use App\Post;
use CloudCreativity\LaravelJsonApi\Validation\AbstractValidators;

class Validators extends AbstractValidators
{

    /**
     * @var array
     */
    protected $allowedSortParameters = [
        'created-at',
        'updated-at',
        'title',
        'slug',
    ];

    /**
     * @var array
     */
    protected $allowedFilteringParameters = [
        'id',
        'title',
        'slug',
    ];

    /**
     * @var array
     */
    protected $allowedIncludePaths = ['author', 'tags'];

    /**
     * @param Post|null $record
     * @return array
     */
    protected function rules($record = null): array
    {
        $slugUnique = 'unique:posts,slug';

        if ($record) {
            $slugUnique .= ',' . $record->getKey();
        }

        return [
            'title' => "required|string|between:1,255",
            'content' => "required|string|min:1",
            'slug' => "required|alpha_dash|$slugUnique",
            'tags' => 'array',
            'tags.*.type' => 'in:tags',
        ];
    }

    /**
     * @return array
     */
    protected function queryRules(): array
    {
        return [
            'filter.title' => 'string|min:1',
            'filter.slug' => 'sometimes|required|alpha_dash',
            'page.number' => 'integer|min:1',
            'page.size' => 'integer|between:1,50',
        ];
    }

}
