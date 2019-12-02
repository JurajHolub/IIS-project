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

Route::get('/users/profile/{user}/edit', 'EditProfileController@profile')->middleware('auth', 'customer');
Route::patch('/users/profile/{user}/edit', 'EditProfileController@updateuser')->middleware('auth', 'customer');
Route::patch('/users/profile/{user}/passwd', 'EditProfileController@updatepasswd')->middleware('auth', 'customer');
Route::delete('/users/profile/{user}', 'EditProfileController@destroyUser')->middleware('auth', 'customer');

Route::get('/products', 'ProductController@index')->name('products');
Route::get('/products/create', 'ProductController@create')->middleware('auth', 'director');
Route::post('/products', 'ProductController@store')->middleware('auth', 'director');
Route::get('/products/{product}', 'ProductController@show');
Route::get('/products/{product}/edit', 'ProductController@edit')->middleware('auth', 'director');
Route::patch('/products/{product}/edit', 'ProductController@update')->middleware('auth', 'director');
Route::delete('/products/{product}', 'ProductController@destroy')->middleware('auth', 'director');

Route::post('/products/{product}/parts', 'ProductPartController@store')->middleware('auth', 'director');
Route::get('/products/{product}/parts/{part}/edit', 'ProductPartController@edit')->middleware('auth', 'director');
Route::patch('/products/{product}/parts/{part}', 'ProductPartController@update')->middleware('auth', 'director');
Route::delete('/products/{product}/parts/{part}', 'ProductPartController@destroy')->middleware('auth', 'director');

Route::get('/tickets', 'TicketController@index')->name('issues');
Route::post('/tickets', 'TicketController@store')->middleware('auth', 'customer');
Route::get('/tickets/create', 'TicketController@create')->middleware('auth', 'customer');
Route::post('/tickets/search', 'TicketController@search');
Route::get('/tickets/{ticket}', 'TicketController@show');
Route::get('/tickets/{ticket}/edit', 'TicketController@edit')->middleware('auth', 'customer');
Route::patch('/tickets/{ticket}/edit', 'TicketController@update')->middleware('auth', 'customer');
Route::delete('/tickets/{ticket}', 'TicketController@destroy')->middleware('auth', 'customer');

Route::post('/comments', 'CommentController@store')->middleware('auth', 'customer');

Route::get('/users', 'EditProfileController@index')->name('users')->middleware('auth', 'admin');
Route::post('/users', 'EditProfileController@store')->middleware('auth', 'admin');
Route::get('/users/create', 'EditProfileController@create')->middleware('auth', 'admin');
Route::get('/users/{user}', 'EditProfileController@show')->middleware('auth', 'admin');
Route::get('/users/{user}/edit', 'EditProfileController@edit')->middleware('auth', 'admin');
Route::patch('/users/{user}', 'EditProfileController@updateAdmin')->middleware('auth', 'admin');
Route::delete('/users/{user}', 'EditProfileController@destroyAdmin')->middleware('auth', 'admin');

Route::patch('/solutions/{task}', 'TaskController@solve')->middleware('auth', 'employee');
Route::get('/tasks', 'TaskController@index')->name('tasks')->middleware('auth', 'employee');
Route::get('/tasks/create', 'TaskController@create')->middleware('auth', 'manager');
Route::post('/tasks', 'TaskController@store')->middleware('auth', 'manager');
Route::get('/tasks/{task}', 'TaskController@show')->middleware('auth', 'employee');
Route::get('/tasks/{task}/edit', 'TaskController@edit')->middleware('auth', 'manager');
Route::patch('/tasks/{task}/edit', 'TaskController@update')->middleware('auth', 'manager');
Route::delete('/tasks/{task}', 'TaskController@destroy')->middleware('auth', 'manager');

