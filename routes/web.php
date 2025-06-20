<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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
// home login and register
Route::middleware(['middleware' => 'PreventBackHistory'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('home');
    });
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::middleware(['throttle:10,1'])->group(function () {
        // Uncomment the registration route if you decide to enable public registration
        // Route::post('/register', [RegisterController::class, 'register'])->name('register');
        
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.page');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// admin pages
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['isAdmin', 'auth', 'PreventBackHistory']], function () {
    Route::get('dashboard', [Admin\AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('posts', Admin\PostController::class)->only(['index', 'create', 'edit']);
    Route::resource('categories', Admin\CategoryController::class)->only(['index', 'create', 'edit']);
});

// user pages
Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['isUser', 'auth', 'PreventBackHistory']], function () {
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
});

// blog & book
Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/{category}/{slug}', [PostController::class, 'show'])->name('posts.show');

// contact page
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// author page
Route::get('/author', function () {
    return view('author');
})->name('author');

// featured products page
Route::get('/witchs-picks', function () {
    return view('featured-products');
})->name('witchs-picks');

// contact page form submitted
Route::post('/contact', ContactController::class)->name('contact.submit');

////////// API SEction //////////
//  api in web routes so it has access to user session. Move these to api if refactor to use sanctum.
//////////
// These are in web.php (not api.php) because:
// 1. Admin area uses session-based auth, not tokens
// 2. Leverages existing middleware (isAdmin, auth)
// 3. Simplifies Vue.js integration in admin components
Route::prefix('api')->middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::apiResource('posts', \App\Http\Controllers\Api\Admin\PostController::class)->names([
            'index'   => 'api.admin.posts.index',
            'store'   => 'api.admin.posts.store',
            'show'    => 'api.admin.posts.show',
            'update'  => 'api.admin.posts.update',
            'destroy' => 'api.admin.posts.destroy',
        ]);

        Route::apiResource('categories', \App\Http\Controllers\Api\Admin\CategoryController::class)->names([
            'index'   => 'api.admin.categories.index',
            'store'   => 'api.admin.categories.store',
            'show'    => 'api.admin.categories.show',
            'update'  => 'api.admin.categories.update',
            'destroy' => 'api.admin.categories.destroy',
        ]);
    });

    // Utility APIs used by admin components
    Route::get('featured-image/{post}', [\App\Http\Controllers\Api\PostController::class, 'getFeaturedImage'])->name('api.posts.featured-image');
    Route::get('featured-gif/{post}', [\App\Http\Controllers\Api\PostController::class, 'getFeaturedGif'])->name('api.posts.featured-gif');

    Route::get('categories/sub', [\App\Http\Controllers\Api\CategoryController::class, 'getAllSubCategories'])->name('api.categories.sub');
    Route::get('categories/{category_name}/children', [\App\Http\Controllers\Api\CategoryController::class, 'getChildCategories'])->name('api.categories.children');
    Route::get('categories/main', [\App\Http\Controllers\Api\CategoryController::class, 'getAllParentCategories'])->name('api.categories.parents');
});