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

//Route::get('/','HomeController@welcome');

Route::get('/getplaces','PlaceController@GetPlaces');
Route::get('/getinfo','PlaceController@GetPlaceInfo');
Route::get('/getaccess','PlaceController@GetPlaceAccessebilities');
Route::get('/getcategories','PlaceController@GetCategories');
//Route::get('/getlevels','PlaceController@GetAccessebilityLevel');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/register',function(){
    return redirect('/login');
});


Route::group(['prefix' => 'catalogue', 'middleware' => ['auth']], function() {
	Route::get('/{id}', 'Catalogue@index');
	Route::post('/add', 'Catalogue@add');
	Route::post('/save', 'Catalogue@store');
	Route::post('/delete', 'Catalogue@destroy');
}); 

Route::group(['prefix' => 'places', 'middleware' => ['auth']], function() {
	Route::get('/', 'Places@index');
	Route::post('/edit/{id}', 'Places@edit');
	Route::post('/save', 'Places@store');
	Route::delete('/delete/{id}', 'Places@destroy');
}); 


Route::get('/geo', 'PlaceController@LoadGeo')->middleware('auth');
