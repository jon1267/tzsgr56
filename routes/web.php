<?php

Route::get('/', 'IndexController@blogHome')->name('index.blogHome');
Route::get('/blog/{id}', 'IndexController@blogSingle')->name('index.blogSingle');

Route::get('/category/{category}', 'IndexController@category')->name('index.blogCategory');

//Store comment to article. front page from all users (guests)
Route::resource('comment', 'CommentController', ['only'=>['store']]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
