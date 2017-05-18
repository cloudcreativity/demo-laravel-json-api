<?php

use CloudCreativity\LaravelJsonApi\Routing\ApiGroup as Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

JsonApi::api('v1', [
    'namespace' => 'Api',
    'prefix' => 'v1',
    'as' => 'api-v1::',
], function (Api $api) {
    $api->resource('comments');
    $api->resource('people');
    $api->resource('posts', ['has-one' => 'author', 'has-many' => ['comments', 'tags']]);
    $api->resource('sites');
});
