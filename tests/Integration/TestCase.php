<?php

namespace App\Tests\Integration;

use App\Tests\TestCase as BaseTestCase;
use CloudCreativity\LaravelJsonApi\Testing\InteractsWithModels;
use CloudCreativity\LaravelJsonApi\Testing\MakesJsonApiRequests;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
