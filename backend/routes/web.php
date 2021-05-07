<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'CategoryController@index')->name('home');

// category routes
Route::post('category/deleteCategory', 'CategoryController@deleteCategory')->middleware('auth');
Route::post('category/updateCategory', 'CategoryController@updateCategory')->middleware('auth');
Route::post('category/getById', 'CategoryController@getById')->middleware('auth');
Route::resource('category', 'CategoryController')->middleware('auth');

Route::post('language/deleteLanguage', 'LanguageController@deleteLanguage')->middleware('auth');
Route::post('language/updateLanguage', 'LanguageController@updateLanguage')->middleware('auth');
Route::post('language/getById', 'LanguageController@getById')->middleware('auth');
Route::resource('language', 'LanguageController')->middleware('auth');

Route::post('post/search', 'PostController@searchPost')->middleware('auth');
Route::post('post/changeStatus', 'PostController@changeStatus')->middleware('auth');
Route::get('post/newPost', 'PostController@newPost')->middleware('auth');
Route::post('post/deletePost', 'PostController@deletePost')->middleware('auth');
Route::post('post/updatePost', 'PostController@updatePost')->middleware('auth');
Route::post('post/getById', 'PostController@getById')->middleware('auth');
Route::post('post/updateEntities', 'PostController@updateEntities')->middleware('auth');
Route::resource('post', 'PostController')->middleware('auth');