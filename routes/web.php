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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

Route::get('/getplaces','PlaceController@GetPlaces');

Route::get('/getinfo','PlaceController@GetPlaceInfo');
Route::get('/getaccess','PlaceController@GetPlaceAccessebilities');
Route::get('/getcategories','PlaceController@GetCategories');
Route::get('/getaccessebilities','PlaceController@GetAccessebilities');
Route::get('/geo', 'PlaceController@LoadGeo')->middleware('auth');

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

Route::resource('places', 'PlaceAdminController');
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


