<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.create');

Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');

Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');

Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');

Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');

Route::post('/blogs/{blog}/comments', [CommentController::class, 'store'])->name('blogs.comments.store');

Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/register', [AuthController::class, 'store']);

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/terms', function(){
    return view('terms');
});
