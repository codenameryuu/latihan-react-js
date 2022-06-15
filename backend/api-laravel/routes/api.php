<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(
    [
        'prefix' => 'users',
        'as' => 'users.',
    ],
    function () {
        Route::get('', [UserController::class, 'index'])
            ->name('index');
        Route::post('', [UserController::class, 'store'])
            ->name('store');
        Route::post('{user}', [UserController::class, 'update'])
            ->name('update');
        Route::delete('{user}', [UserController::class, 'destroy'])
            ->name('destroy');
    }
);

Route::group(
    [
        'prefix' => 'articles',
        'as' => 'articles.',
    ],
    function () {
        Route::get('', [ArticleController::class, 'index'])
            ->name('index');
        Route::post('', [ArticleController::class, 'store'])
            ->name('store');
        Route::post('{article}', [ArticleController::class, 'update'])
            ->name('update');
        Route::delete('{article}', [ArticleController::class, 'destroy'])
            ->name('destroy');
    }
);
