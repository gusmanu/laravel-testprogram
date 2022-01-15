<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'ProductController@index')->name('index');
Route::delete('/', 'ProductController@delete');
Route::get('/edit/{id}', 'ProductController@edit')->name('edit')->where('id', '[0-9]+');
Route::post('/edit/{id}', 'ProductController@editSave')->where('id', '[0-9]+');
Route::get('/create', 'ProductController@create')->name('create');
Route::post('/create', 'ProductController@createSave');



