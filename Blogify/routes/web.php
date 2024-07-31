<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/blog', [BlogController::class, 'store'])->name('blog.create');

Route::get('/profile', [ProfileController::class, 'index']);

Route::get('/terms', function(){
    return view('terms');
});
