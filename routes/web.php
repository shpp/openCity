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

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/register',function(){
    return redirect('/login');
});

//Route::get('/loadplaces', 'PlaceController@LoadFromFile')->middleware('auth');
Route::get('/catalogue/{id}', 'Catalogue@index');

Route::get('/geo', 'PlaceController@LoadGeo')->middleware('auth');
/*Route::get('/categories', 'PlaceController@LoadFromFile');
Route::get('/param_name', 'PlaceController@LoadFromFile');
Route::get('/acc_name', 'PlaceController@LoadFromFile');*/