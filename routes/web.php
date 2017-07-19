<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', 'PlaceController@index');
Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::get('/getplaces', 'PlaceController@getPlaces');
Route::get('/getinfo', 'PlaceController@getPlaceInfo');
Route::get('/search', 'PlaceController@searchPlaces');


Auth::routes();
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/cb', 'Auth\AuthController@handleProviderCallback');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('places/create', 'PlaceController@create'); // todo: add create place permission middleware
    Route::post('places/', 'PlaceController@store'); // todo: add create place permission middleware

    Route::get('users/all', 'UsersController@showAll');
    Route::get('/load_file', 'FilesController@index');
    Route::post('/load_file', 'FilesController@load');
    Route::post('/save_file', 'FilesController@save');
    Route::resource('admin/places', 'PlaceAdminController');

    Route::get('/destroy_null', 'PlaceAdminController@destroyNull');
    Route::get('/load_geo', 'PlaceAdminController@loadGeo');
    Route::get('/messages', 'MessageController@index');

    Route::resource('parameter_types', 'ParameterTypesController');
    Route::resource('parameters', 'ParametersController');

    Route::group(['prefix' => 'catalogue',], function () {
        Route::get('/{id}', 'CatalogueController@index');
        Route::post('/add', 'CatalogueController@add');
        Route::post('/save', 'CatalogueController@store');
        Route::post('/delete', 'CatalogueController@destroy');
    });
});


Route::post('/messages', 'MessageController@store');
/*
Verb	Path	            Action	Route Name
GET	    /photo	            index	photo.index
GET	    /photo/create	    create	photo.create
POST	/photo	            store	photo.store
GET	    /photo/{photo}	    show	photo.show
GET	    /photo/{photo}/edit	edit	photo.edit
PATCH	/photo/{photo}	    update	photo.update
DELETE	/photo/{photo}	    destroy	photo.destroy
*/

Route::get('/home', 'HomeController@index');

Route::get('/places', 'PlacesController@all');
Route::get('/places/{id}', 'PlacesController@show');
Route::get('/place/{id}/comments/', 'PlaceController@getComments');

Route::group(['middleware' => ['auth', 'banned']], function () {
    Route::post('/place-comments', 'PlaceCommentsController@addPlaceComment');
    Route::delete('/place-comments/{id}', 'PlaceCommentsController@delete');
});