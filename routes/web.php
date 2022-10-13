<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

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
Route::model('posts', 'Post');

Route::middleware(['middleware'=>'PreventBackHistory'])->group(function () {
    Route::get('/', function() { return view('index'); });
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/contact', function () { return view('contact'); })->name('contact');

Route::group(['prefix'=>'admin', 'as' => 'admin.', 'middleware'=>['isAdmin', 'auth', 'PreventBackHistory']], function() {
    Route::get('dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
});

Route::group(['prefix'=>'user', 'as' => 'user.', 'middleware'=>['isUser', 'auth', 'PreventBackHistory']], function() {
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
});

Route::resource('posts', \App\Http\Controllers\PostController::class)->only([
    'index', 'show'
]);
