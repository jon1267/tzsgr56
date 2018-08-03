<?php

Route::get('/', 'IndexController@blogHome')->name('index.blogHome');
Route::get('/blog/{id}', 'IndexController@blogSingle')->name('index.blogSingle');

//Store comment to article. front page from all users (guests)
Route::resource('comment', 'CommentController', ['only'=>['store']]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
