<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ArticleController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/validate', [AuthController::class, 'validateEmail']);

Route::group(['prefix' => 'user'], function() {
    Route::post('create', [AuthController::class, 'store']);
    Route::post('login', [AuthController::class, 'login']);

});

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/auth/init', [AuthController::class, 'user']);

    Route::group(['prefix' => 'user'], function() {
        Route::post('logout', [AuthController::class, 'logout']);
    });

    Route::prefix('articles')->group(function () {
        Route::post('postComment', [ArticleController::Class, 'postComment']);
    });
});

Route::prefix('articles')->group(function () {

    Route::post('{id}/like', [ArticleController::class, 'like']);
    Route::post('{id}/views', [ArticleController::class, 'view']);
    
    Route::get('{id}/comment', [ArticleController::class, 'comment']);
    Route::get('{id}', [ArticleController::class, 'show']);
    Route::get('/', [ArticleController::class, 'index']);

});
