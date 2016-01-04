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

Route::get('/', function () {
    return view('login');
});
Route::get('regForm', function () {
    return view('regForm');
});
Route::get('/main', 'MainController@myprofile');
Route::post('login', 'UsersController@login');
Route::post('register', 'UsersController@register');
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