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

use App\Board;

Route::get('/', function () {
   return view('welcome');
});

Route::get('/welcome', function () {
   return view('home.welcome');
});


Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/boards', 'HomeController@boards');

Route::post('/save-board', 'HomeController@save_board');
Route::post('/save-card', 'HomeController@save_card');
Route::post('/save-check', 'HomeController@save_check');
Route::get('/check-lists/{id?}', 'HomeController@check_lists');
Route::post('/done-list', 'HomeController@done_list');

Route::post('/save-list', 'HomeController@save_list');
Route::match(['get','post'], '/register', 'Auth\RegisterController@register');
Route::get('/login', 'Auth\LoginController@get_login');
Route::post('/login','Auth\LoginController@login');
Route::post('/add-board-member', 'HomeController@add_board_member');
Route::get('board/{slug?}', 'HomeController@view_board');
Route::get('/members', 'HomeController@members');

Route::get('home/card-element','HomeController@card_element');