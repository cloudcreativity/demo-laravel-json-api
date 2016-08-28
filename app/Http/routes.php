<?php

/**
 * Web Routes
 */
Route::group([
    'middleware' => 'web',
], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

/**
 * API v1
 *
 * We use a middleware group called `api-v1` that adds the `json-api` middleware and others, e.g.
 * `throttle`.
 */
Route::group([
    'middleware' => ['api-v1'],
    'namespace' => 'Api',
    'prefix' => 'api/v1',
    'as' => 'api-v1::'
], function () {
    JsonApi::resource('people');
    JsonApi::resource('posts');
});
