<?php

namespace Tests\Feature;

use CloudCreativity\LaravelJsonApi\Testing\InteractsWithModels;
use CloudCreativity\LaravelJsonApi\Testing\MakesJsonApiRequests;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{

    use MakesJsonApiRequests,
        InteractsWithModels,
        DatabaseTransactions;

    /**
     * @var string
     */
    protected $api = 'v1';

}
