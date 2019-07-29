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

Route::get('/', 'bankController@index');
//Route::post('/create', 'bankController@create');
Route::get('/create', 'bankController@create');
Route::post('/', 'bankController@store');
Route::get('/search', 'bankController@search');
Route::post('/search', 'bankController@fetch');