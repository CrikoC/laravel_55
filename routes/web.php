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


Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

//Registration routes
Route::get('auth/register',  'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');



//resource routes
Route::resource('categories',   'CategoryController');
Route::resource('posts',        'PostController');
Route::resource('tags',         'TagController', ['except' => ['create']]);

//Comment routes
Route::post('comments/{post_id}',       'CommentsController@store'  )->name('comments.store');
Route::get('comments/{id}/edit',        'CommentsController@edit'   )->name('comments.edit');
Route::put('comments/{id}/update',      'CommentsController@update' )->name('comments.update');
Route::delete('comments/{id}/destroy',  'CommentsController@destroy')->name('comments.destroy');
Route::get('comments/{id}/delete',      'CommentsController@delete' )->name('comments.delete');

//get routes
Route::get('/blog/{slug}',  'BlogController@getSingle'  )->where('slug', '[\w\d\-\_]+')->name('blog.single');
Route::get('blog',          'BlogController@getIndex'   )->name('blog.index');
Route::get('contact',       'PagesController@getContact')->name('pages.contact');

Route::get('about',         'PagesController@getAbout'  )->name('pages.about');
Route::get('/',             'PagesController@getIndex'  )->name('pages.home');
Route::get('/admin/',       'AdminController@index'     )->name('admin.index');

//Route::get('posts',         'PostController@index'      )->name('posts.index');
//Route::post('posts',        'PostController@store'      )->name('posts.store');
//Route::get('posts/{id?}',   'PostController@show'       )->name('posts.show');
//Route::put('posts/{id?}',   'PostController@update'     )->name('posts.update');
//Route::delete('posts/{id?}','PostController@destroy'    )->name('posts.destroy');

//Check routes
Route::get('/checkTitle', 'PostController@check_title')->name('posts.check');

