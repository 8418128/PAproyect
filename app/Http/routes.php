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


Route::get('/main', 'MainController@myprofile');
Route::post('doLog', 'UsersController@login');
Route::post('doReg', 'UsersController@register');
Route::post('uploadCanvas', 'CanvasController@save');
Route::post('resize', 'CanvasController@resizeImage');
Route::get('/canvas', function () {
    return view('canvas');
});

Route::get('/joder','CanvasController@r2');

Route::get('/broadcast/{channel}', function($channel) {
    return view('welcome')->with('channel',$channel);
});

Route::post('push', 'CanvasController@push');

Route::get('lastmod', 'CanvasController@lastmod');
Route::post('uploadPreview', 'CanvasController@savePreview');
Route::get('uploadPreview', 'CanvasController@savePreview');

Route::get('/', function () {
    return view('login_snippet');
});

Route::get('register', function () {
    return view('register_snippet');
});

Route::get('/profile','UsersController@getProfile');

Route::get('/edit','UsersController@getProfile');
Route::post('/saveProfile','UsersController@update');
