<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{

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
