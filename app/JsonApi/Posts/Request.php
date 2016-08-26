<?php

namespace App\JsonApi\Posts;

use CloudCreativity\LaravelJsonApi\Http\Requests\AbstractRequest;

class Request extends AbstractRequest
{

    /**
     * @var string
     */
    protected $resourceType = Schema::RESOURCE_TYPE;

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
        parent::__construct($validator);
    }

}
