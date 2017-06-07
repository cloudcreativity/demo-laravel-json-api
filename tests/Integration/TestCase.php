<?php

namespace App\Tests\Integration;

use App\Tests\BrowserKitTest;
use CloudCreativity\LaravelJsonApi\Testing\InteractsWithModels;
use CloudCreativity\LaravelJsonApi\Testing\InteractsWithResources;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class TestCase extends BrowserKitTest
{

    use InteractsWithResources,
        InteractsWithModels,
        DatabaseTransactions;

    /**
     * Return the prefix for route names for the resources we're testing...
     *
     * @return string
     */
    protected function getRoutePrefix()
    {
        return 'api-v1::';
    }
}
