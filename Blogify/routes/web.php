<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.create');

Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');

Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');

Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');

Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');

Route::get('/terms', function(){
    return view('terms');
});
