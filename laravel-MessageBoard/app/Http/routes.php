<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::resource('/','Homepage');
Route::resource('/MessageBoard', 'MessageBoardController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


// Route::get('auth/login', 'Auth\AuthController@getLogin');


Route::get('/Work','WorkController@index');
Route::get('/Work/quest1',function ()    {
    return view('work/quest1');
});
Route::get('/Work/quest2',function ()    {
    return view('work/quest2');
});
Route::get('/Work/design',function ()    {
    return view('work/design');
});
Route::post('/Work/tempsave','WorkController@tempsave');
Route::post('/Work/save','WorkController@save');




