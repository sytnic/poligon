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

Route::get('/', function () {
    return view('welcome');
});

// чтобы не указывать отдельно get, post , delete.. для маршрутов, 
//   можно указать одной строкой:
// указываются uri, controller, имя маршрута names
Route::resource('rest', 'RestTestController')->names('restTest');
// ->names('restTest'); имя маршрута можно не задавать
