<?php

namespace App\JsonApi\Posts;

use CloudCreativity\LaravelJsonApi\Http\Requests\AbstractRequestHandler;

class Request extends AbstractRequestHandler
{

    /**
     * @var array
     */
    protected $hasOne = [
        'author'
    ];

    /**
     * @var array
     */
    protected $hasMany = [
        'comments'
    ];

    /**
     * @var array
     */
    protected $allowedSortParameters = [
        'created_at',
        'updated_at',
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
     * Request constructor.
     * @param Validators $validator
     */
    public function __construct(Validators $validator)
    {
        parent::__construct(null, $validator);
    }

    /**
     * @return string
     */
    public function getResourceType()
    {
        return Schema::RESOURCE_TYPE;
    }

}
