<?php

namespace Tests\Feature;

use Carbon\Carbon;
use CloudCreativity\LaravelJsonApi\Testing\MakesJsonApiRequests;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{

    use MakesJsonApiRequests,
        DatabaseTransactions;

    /**
     * @var string
     */
    protected $api = 'v1';

    /**
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
        Carbon::setTestNow('2018-01-01 12:00:00');
    }

    /**
     * @return void
     */
    protected function tearDown()
    {
        parent::tearDown();
        Carbon::setTestNow();
    }

}
