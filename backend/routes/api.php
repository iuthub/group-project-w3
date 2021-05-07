<?php

use Illuminate\Http\Request;
use App\Http\Controllers\DriverAuthController;
use App\Http\Controllers\ApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'blog'

], function ($router) {
    Route::get('/get_languages', [ApiController::class, 'getLanguages']);
    Route::post('/get_post', [ApiController::class, 'getPost']);
    Route::get('/get_posts', [ApiController::class, 'getPosts']);
    Route::get('/get_categories', [ApiController::class, 'getCategories']); 
    Route::post('/get_posts_by_category', [ApiController::class, 'getCategoryPosts']); 
    Route::post('/check_ip', [ApiController::class, 'checkIp']); 
    Route::post('/create_post', [ApiController::class, 'createPost']); 
    Route::get('/get_populars', [ApiController::class, 'getPopulars']);
    Route::post('/get_populars_by_category', [ApiController::class, 'getCategoryPopulars']); 
    Route::post('/search_post', [ApiController::class, 'searchPost']); 
});
