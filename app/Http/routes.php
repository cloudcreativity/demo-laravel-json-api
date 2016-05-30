<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware' => 'json-api:/api/v1,v1',
    'namespace' => 'Api',
    'prefix' => 'api/v1',
], function () {
    JsonApi::resource('people', 'PeopleController');
});
