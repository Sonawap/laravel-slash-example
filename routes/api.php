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

Route::prefix('articles')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('postComment', [ArticleController::Class, 'postComment']);
    });

    Route::get('{id}/comment', [ArticleController::class, 'comment']);
    Route::get('{id}', [ArticleController::class, 'show']);
    Route::get('/', [ArticleController::class, 'index']);
    Route::get('{id}/like', [ArticleController::class, 'like']);
    Route::get('{id}/views', [ArticleController::class, 'like']);
    
});
