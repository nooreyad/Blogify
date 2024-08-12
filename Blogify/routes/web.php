<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix' => 'blogs/', 'as' => 'blogs.', 'middleware' => ['auth']], function () {

    Route::post('', [BlogController::class, 'store'])->name('create');

    Route::get('{blog}', [BlogController::class, 'show'])->name('show');

    Route::group(['middleware' => ['auth']], function () {

        Route::get('{blog}/edit', [BlogController::class, 'edit'])->name('edit');

        Route::put('{blog}', [BlogController::class, 'update'])->name('update');

        Route::delete('{blog}', [BlogController::class, 'destroy'])->name('destroy');

        Route::post('{blog}/comments', [CommentController::class, 'store'])->name('comments.store');
    });
});

Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/register', [AuthController::class, 'store']);

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('users', UserController::class)->only('show', 'edit', 'update')->middleware('auth');

Route::get('profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');

Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->middleware('auth')->name('users.follow');

Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->middleware('auth')->name('users.unfollow');

Route::get('/terms', function(){
    return view('terms');
})->name('terms');
