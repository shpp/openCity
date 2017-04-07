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

Route::get('/','PlaceController@index');
Route::get('/home',function(){
    return view('home');
})->middleware('auth');

Route::get('/getplaces','PlaceController@getPlaces');
Route::get('/getinfo','PlaceController@getPlaceInfo');
Route::get('/search','PlaceController@searchPlaces');

Route::get('/load_file','FilesController@index');
Route::post('/load_file','FilesController@load');
Route::post('/save_file','FilesController@save');

Auth::routes();

Route::get('/register',function(){
    return redirect('/login');
});


Route::group(['prefix' => 'catalogue', 'middleware' => ['auth']], function() {
	Route::get('/{id}', 'CatalogueController@index');
	Route::post('/add', 'CatalogueController@add');
	Route::post('/save', 'CatalogueController@store');
	Route::post('/delete', 'CatalogueController@destroy');
}); 
Route::resource('parameter_types', 'ParameterTypesController');
Route::resource('parameters', 'ParametersController');
Route::resource('places', 'PlaceAdminController');

Route::post('messages', 'MessageController@store');
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
Route::get('/destroy_null','PlaceAdminController@destroyNull');
Route::get('/load_geo','PlaceAdminController@loadGeo');