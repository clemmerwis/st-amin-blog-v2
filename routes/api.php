<?php

use \App\Http\Controllers\Api\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::get('admin/posts', [Admin\PostController::class, 'index'])->name('api.posts.index');
Route::prefix('admin')->group(function () {
    Route::apiResource('posts', Admin\PostController::class)->except('update')->names([
        'index' => 'api.posts.index',
        'store' => 'api.posts.store',
        'show' => 'api.posts.show',
        // 'update' => 'api.posts.update',
        'destroy' => 'api.posts.destroy',
    ]);

    // define update route as post for formData files
    Route::post('posts/{post}', [Admin\PostController::class, 'update'])->name('api.posts.update');
});