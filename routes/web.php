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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes(['reset' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'EditProfileController@index')->name('profile');
Route::post('/profile', 'EditProfileController@update');

Route::get('/products', 'ProductController@index')->name('products');
Route::get('/products/create', 'ProductController@create')->middleware('auth');
Route::post('/products', 'ProductController@store')->middleware('auth');
Route::get('/products/{product}', 'ProductController@show');
Route::get('/products/{product}/edit', 'ProductController@edit');
Route::patch('/products/{product}/edit', 'ProductController@update');
Route::delete('/products/{product}', 'ProductController@destroy');

Route::post('/products/{product}/parts', 'ProductPartController@store');
Route::patch('/products/{product}/parts/{part}', 'ProductPartController@update');
Route::delete('/products/{product}/parts/{part}', 'ProductPartController@destroy');

Route::get('/tickets', 'TicketController@index')->name('issues');
Route::post('/tickets', 'TicketController@store');
Route::get('/tickets/create', 'TicketController@create');
Route::get('/tickets/{detail}', 'TicketController@show');

Route::post('/comments', 'CommentController@store');

Route::get('/users', 'EditProfileController@index')->name('users');
Route::post('/users', 'EditProfileController@store');
Route::get('/users/create', 'EditProfileController@create');
Route::get('/users/{user}', 'EditProfileController@show');
Route::get('/users/{user}/edit', 'EditProfileController@edit');
Route::patch('/users/{user}', 'EditProfileController@update');
Route::delete('/users/{user}', 'EditProfileController@destroy');

Route::get('/tasks', 'TaskController@index')->name('tasks');
Route::get('/tasks/create', 'TaskController@create');
Route::post('/tasks', 'TaskController@store');
Route::get('/tasks/{task}', 'TaskController@show');
Route::get('/tasks/{task}/edit', 'TaskController@edit');
Route::patch('/tasks/{task}/edit', 'TaskController@update');
Route::delete('/tasks/{task}', 'TaskController@destroy');
