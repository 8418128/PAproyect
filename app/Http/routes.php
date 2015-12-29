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
Route::get('/canvas', function () {
    return view('canvas');
});

Route::get('/joder', function () {
    $json = json_decode(file_get_contents('https://socpa:asdargonnijao@socpa.cloudant.com/users/_design/default/_view/new-view?limit=20&reduce=false'), true);
    print_r($json);

    return "ok";
});

Route::get('/broadcast/{channel}', function($channel) {
    return view('welcome')->with('channel',$channel);
});

Route::get('/push/{c}/{m}',function($c,$m){
    //event(new \App\Events\PruebaEvento($c,$m));
    event(new \App\Events\ChEvent($c,$m));
});