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
Route::post('/products', 'ProductController@store')->middlewarw('auth');
Route::get('/products/{detail}', 'ProductController@show');

Route::get('/tickets', 'TicketController@index')->name('issues');
Route::post('/tickets', 'TicketController@store');
Route::get('/tickets/create', 'TicketController@create');
Route::get('/tickets/{detail}', 'TicketController@show');

Route::post('/comments', 'CommentController@store');
Route::post('/product_parts', 'ProductPartController@store');
