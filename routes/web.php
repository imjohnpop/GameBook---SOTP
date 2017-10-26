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

Route::any('/', 'IndexController@index');
Route::any('/book', 'IndexController@start')->middleware('auth');

Route::get('/home', function () {
    return redirect('/');
});



Auth::routes();
