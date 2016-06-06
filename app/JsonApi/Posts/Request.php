<?php

namespace App\JsonApi\Posts;

use CloudCreativity\LaravelJsonApi\Http\Requests\AbstractRequest;
use CloudCreativity\LaravelJsonApi\Http\Requests\ForbidsRequests;
use Illuminate\Http\Request as HttpRequest;

class Request extends AbstractRequest
{

    use ForbidsRequests;

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
        'title',
        'slug',
    ];

    /**
     * Request constructor.
     * @param HttpRequest $request
     * @param Validators $validator
     */
    public function __construct(HttpRequest $request, Validators $validator)
    {
        parent::__construct($request, $validator);
    }

    /**
     * @return string
     */
    public function getResourceType()
    {
        return 'posts';
    }
}
