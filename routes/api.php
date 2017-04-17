<?php

use Illuminate\Http\Request;

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


Route::group(['prefix' => 'v1'], function () {
    Route::get('/getplaces', 'ApiV1Controller@getPlaces');
    Route::get('/getinfo', 'ApiV1Controller@getPlaceInfo');
    //Route::get('/getaccess','ApiV1Controller@GetPlaceAccessebilities');
    Route::get('/getcategories', 'ApiV1Controller@getCategories');
    Route::get('/getaccessebilities', 'ApiV1Controller@getAccessebilities');
    Route::get('/getparameters', 'ApiV1Controller@getParameters');
});

