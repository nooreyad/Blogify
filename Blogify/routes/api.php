<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

Route::post('login', [AuthController::class, 'login']);

Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:api')->get('profile', [ProfileController::class, 'show']);

Route::group(['prefix' => 'blogs/', 'middleware' => ['auth:api']], function () {
    Route::get('', [BlogController::class, 'show']);

    Route::post('', [BlogController::class, 'store']);

    Route::post('{id}/edit', [BlogController::class, 'edit']);

    Route::delete('{blog}', [BlogController::class, 'delete']);

    Route::post('{blog}/comments', [CommentController::class, 'store']);
});

Route::group(['prefix' => 'users/{user}/', 'middleware' => ['auth:api']], function () {
    Route::get('', [UserController::class, 'show']);

    Route::post('edit', [UserController::class, 'edit']);

    Route::post('follow', [FollowerController::class, 'follow']);

    Route::post('unfollow', [FollowerController::class, 'unfollow']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth:api']], function () {

    Route::post('login', [App\Http\Controllers\Admin\AuthController::class, 'login']);

    Route::get('profile', [ProfileController::class, 'show']);

    Route::post('registerAdmin', [App\Http\Controllers\Admin\AuthController::class, 'register']);

    Route::group(['prefix' => 'blogs'], function () {

        Route::get('', [BlogController::class, 'show']);

        Route::delete('{blog}', [BlogController::class, 'delete']);

        Route::delete('{blog}/comments/{comment}', [CommentController::class, 'destroy']);

    });

    Route::group(['prefix' => 'users/{user}'], function () {

        Route::get('', [UserController::class, 'show']);

    });
});

