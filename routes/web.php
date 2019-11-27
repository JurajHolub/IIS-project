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

Route::get('/users/profile/{user}/edit', 'EditProfileController@profile')->middleware('customer');
Route::post('/users/profile/{user}/edit', 'EditProfileController@updateUser')->middleware('customer');
Route::post('/users/profile/{user}/passwd', 'EditProfileController@updatePasswd')->middleware('customer');
Route::delete('/users/profile/{user}', 'EditProfileController@destroyUser')->middleware('customer');

Route::get('/products', 'ProductController@index')->name('products');
Route::get('/products/create', 'ProductController@create')->middleware('auth');
Route::post('/products', 'ProductController@store')->middleware('auth');
Route::get('/products/{product}', 'ProductController@show');
Route::get('/products/{product}/edit', 'ProductController@edit');
Route::patch('/products/{product}/edit', 'ProductController@update');
Route::delete('/products/{product}', 'ProductController@destroy');

Route::post('/products/{product}/parts', 'ProductPartController@store');
Route::get('/products/{product}/parts/{part}/edit', 'ProductPartController@edit');
Route::patch('/products/{product}/parts/{part}', 'ProductPartController@update');
Route::delete('/products/{product}/parts/{part}', 'ProductPartController@destroy');

Route::get('/tickets', 'TicketController@index')->name('issues');
Route::post('/tickets', 'TicketController@store');
Route::get('/tickets/create', 'TicketController@create');
Route::get('/tickets/search', 'TicketController@search');
Route::get('/tickets/{ticket}', 'TicketController@show');
Route::get('/tickets/{ticket}/edit', 'TicketController@edit');
Route::patch('/tickets/{ticket}/edit', 'TicketController@update');
Route::delete('/tickets/{ticket}', 'TicketController@destroy');

Route::post('/comments', 'CommentController@store');

Route::get('/users', 'EditProfileController@index')->name('users')->middleware('admin');
Route::post('/users', 'EditProfileController@store')->middleware('admin');
Route::get('/users/create', 'EditProfileController@create')->middleware('admin');
Route::get('/users/{user}', 'EditProfileController@show')->middleware('admin');
Route::get('/users/{user}/edit', 'EditProfileController@edit')->middleware('admin');
Route::patch('/users/{user}', 'EditProfileController@updateAdmin')->middleware('admin');
Route::delete('/users/{user}', 'EditProfileController@destroyAdmin')->middleware('admin');

Route::get('/tasks', 'TaskController@index')->name('tasks');
Route::get('/tasks/create', 'TaskController@create');
Route::post('/tasks', 'TaskController@store');
Route::get('/tasks/{task}', 'TaskController@show');
Route::get('/tasks/{task}/edit', 'TaskController@edit');
Route::patch('/tasks/{task}/edit', 'TaskController@update');
Route::delete('/tasks/{task}', 'TaskController@destroy');
