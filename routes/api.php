<?php

use App\Http\Controllers\Api\Admin;
use App\Http\Controllers\Api\PostController;
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
        'index' => 'api.admin.posts.index',
        'store' => 'api.admin.posts.store',
        'show' => 'api.admin.posts.show',
        // 'update' => 'api.posts.update',
        'destroy' => 'api.admin.posts.destroy',
    ]);
    // define update route as post for formData files
    Route::post('posts/{post}', [Admin\PostController::class, 'update'])->name('api.posts.update');
});

Route::get('featured-image/{post}', [PostController::class, 'getFeaturedImage'])->name('api.posts.featured-image');