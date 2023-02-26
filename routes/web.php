<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::middleware(['middleware'=>'PreventBackHistory'])->group(function () {
    Route::get('/', function() { return view('index'); });
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// admin pages
Route::group(['prefix'=>'admin', 'as' => 'admin.', 'middleware'=>['isAdmin', 'auth', 'PreventBackHistory']], function() {
    Route::get('dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
});

// user pages
Route::group(['prefix'=>'user', 'as' => 'user.', 'middleware'=>['isUser', 'auth', 'PreventBackHistory']], function() {
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
});

// posts - show uses slug rather than id
Route::resource('posts', PostController::class)->only([
    'index', 'show'
])->parameters(['posts' => 'slug']);

// contact page
Route::get('/contact', function () { return view('contact'); })->name('contact');
