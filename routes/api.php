<?php

use App\Http\Controllers\Api\Admin;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
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

// Route::get('admin/posts', [Admin\PostController::class, 'index'])->name('api.posts.index');
Route::prefix('admin')->group(function () {
    Route::apiResource('posts', Admin\PostController::class)->except('update')->names([
        'index'   => 'api.admin.posts.index',
        'store'   => 'api.admin.posts.store',
        'show'    => 'api.admin.posts.show',
        // 'update' => 'api.posts.update',
        'destroy' => 'api.admin.posts.destroy',
    ]);
    // define update route as post for formData files
    Route::post('posts/{post}', [Admin\PostController::class, 'update'])->name('api.posts.update');
});

Route::get('featured-image/{post}', [PostController::class, 'getFeaturedImage'])->name('api.posts.featured-image');
Route::get('featured-gif/{post}', [PostController::class, 'getFeaturedGif'])->name('api.posts.featured-gif');

// New routes for CategoryController
Route::get('categories/sub', [CategoryController::class, 'getAllSubCategories'])->name('api.categories.sub');
Route::get('categories/{category_name}/children', [CategoryController::class, 'getChildCategories'])->name('api.categories.children');
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
