<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    /** We have a middleware group called `api-v1` that adds the `json-api` middleware and others e.g. throttle */
    'middleware' => ['api-v1'],
    'namespace' => 'Api',
    'prefix' => 'api/v1',
    'as' => 'api-v1::'
], function ($router) {
    JsonApi::resource('people', 'PeopleController');
});
