<?php

use App\Http\Controllers\GeminiController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\DashboardPostsController;
use App\Http\Controllers\DashboardKeywordsController;


Route::get('/', function () {
    return view('home', ['posts' => Post::all()]);
});

Route::get('/about', function (){
    return view ('about', ['posts' => Post::all()]);
});

Route::get('/chat', function (){
    return view('chat');
});

Route::get('/dashboard', function (){
    return view('dashboard.index');
})->middleware('auth');

Route::get('/chat', [GeminiController::class, 'geminiQuestion']);
Route::get('/chat/keywords', [GeminiController::class, 'getKeywords']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::post('/dashboard/posts/checkSlug', [DashboardPostsController::class, 'checkSlug']);
Route::resource('/dashboard/posts', DashboardPostsController::class)->middleware('auth');

Route::resource('/dashboard/keywords', DashboardKeywordsController::class)->except('show')->middleware('auth');





