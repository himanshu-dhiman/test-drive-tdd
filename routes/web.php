<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/user/{id}', 'UsersController@show');
Route::get('/event/{id}', 'EventController@show');
Route::post('/event/{id}/tickets', 'EventController@buyTicket');