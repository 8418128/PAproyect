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
Route::get('home','CanvasController@paintingHome');
Route::post('doReg', 'UsersController@register');
Route::get('search', 'FriendsController@getPeticiones');
Route::post('uploadCanvas', 'CanvasController@save');
Route::post('resize', 'CanvasController@resizeImage');
Route::get('/canvas', function () {
    return view('canvas');
});
Route::get('/', function () {
    return view('login_snippet');
});

Route::get('register', function () {
    return view('register_snippet');
});

Route::get('/myProfile','UsersController@getMyProfile');
Route::get('/editProfile','UsersController@getProfile2');
Route::post('/updateProfile','UsersController@update');
Route::get('friendProfile/{id}','UsersController@getProfile3');
Route::get('sendFriend/{id}','FriendsController@send');
Route::get('sendFriend2/{id}','FriendsController@send2');
Route::get('sendFriend3/{id}','FriendsController@send3');
Route::get('search2','FriendsController@getPeticiones');
Route::post('lookFor','FriendsController@lookFor');
Route::get('addFriend/{id}','FriendsController@add');
Route::get('declinedFriend/{id}','FriendsController@declined');
Route::get('declinedFriend2/{id}','FriendsController@declined2');

Route::get('/broadcast/{channel}', function($channel) {
    return view('welcome')->with('channel',$channel);
});

Route::post('push', 'CanvasController@push');
Route::post('pushChat', 'ChatController@push');

Route::get('lastmod', 'CanvasController@lastmod');
Route::post('uploadPreview', 'CanvasController@savePreview');
Route::get('uploadPreview', 'CanvasController@savePreview');

Route::get('atelier','CanvasController@viewMyCanvas');
Route::get('gallery','CanvasController@viewMyPainting');


Route::get('register', function () {
    return view('register_snippet');
});

Route::get('/profile','UsersController@getProfile');

Route::get('/edit','UsersController@getProfile');
Route::post('/saveProfile','UsersController@update');

Route::get('chats','ChatController@getChatFromFriend');
Route::get('/chaty', function () {
    return view('chatView');
});
Route::post('comment','CanvasController@comment');
Route::post('likeComment','UsersController@likeComment');