<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\UserController;

Route::get('/', [DashboardController::class, 'show'])->name('dashboard');

Route::group(['prefix' => 'blogs/', 'as' => 'blogs.', 'middleware' => ['auth']], function () {

    Route::post('', [BlogController::class, 'store'])->name('create');

    Route::get('{blog}', [BlogController::class, 'show'])->name('show');

    Route::group(['prefix' => '{blog}/', 'middleware' => ['auth']], function () {

        Route::get('edit', [BlogController::class, 'edit'])->name('edit');

        Route::put('', [BlogController::class, 'update'])->name('update');

        Route::delete('', [BlogController::class, 'destroy'])->name('destroy');

        Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
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

// Route::group(['prefix' =>'/admin'], function(){

//     Route::get('', [DashboardController::class, 'show'])->name('dashboard');

//     Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login');


//     Route::group(['prefix' => 'blogs/{blog}/', 'middleware' => ['auth']], function () {

//         Route::get('', [BlogController::class, 'show'])->name('show');

//         Route::delete('', [BlogController::class, 'destroy'])->name('destroy');

//         Route::post('comments', [CommentController::class, 'destroy'])->name('comments.store');
//     });
// });
