<?php

namespace App\JsonApi\Tags;

use App\Tag;
use CloudCreativity\LaravelJsonApi\Store\EloquentAdapter;

class Adapter extends EloquentAdapter
{

    public function __construct()
    {
        parent::__construct(new Tag());
    }
}
