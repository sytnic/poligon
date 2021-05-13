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

Route::group(['namespace'=>'Blog','prefix'=>'blog'], function(){
    Route::resource('posts', 'PostController')->names('blog.posts');
});
// для отображения индексного маршрута будет работать /blog/posts/ в адресной строке браузера
// Префикс и namespace можно было указать и так
/*
    Route::resource('blog/posts', 'Blog/PostController')->names('blog.posts');
*/
