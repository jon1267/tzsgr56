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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'IndexController@blogHome')->name('index.blogHome');
Route::get('/blog/{id}', 'IndexController@blogSingle')->name('index.blogSingle');
//Store comment to article. front page from all users (guests)
Route::resource('comment', 'CommentController', ['only'=>['store']]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
