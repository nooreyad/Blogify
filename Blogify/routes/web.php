<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;


Route::get('/', [DashboardController::class, 'index']);

Route::get('/profile', [ProfileController::class, 'index']);

Route::get('/terms', function(){
    return view('terms');
});
