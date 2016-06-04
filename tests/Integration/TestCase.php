<?php

namespace App\Tests\Integration;

use App\Tests\TestCase as AppTestCase;
use CloudCreativity\LaravelJsonApi\Testing\InteractsWithModels;
use CloudCreativity\LaravelJsonApi\Testing\MakesJsonApiRequests;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class TestCase extends AppTestCase
{

    use MakesJsonApiRequests,
        InteractsWithModels,
        DatabaseTransactions;

}
