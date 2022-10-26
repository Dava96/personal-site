<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('posts.home');
Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('register', [RegisterController::class, 'create'])->middleware('guest')->name('register.create');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest')->name('register.store');

Route::get('login', [SessionController::class, 'create'])->middleware('guest')->name('session.create');
Route::post('login', [SessionController::class, 'store'])->middleware('guest')->name('session.store');
Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth')->name('session.destroy');

Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store'])->middleware('auth');

//Admin

Route::middleware('can:admin')->group(function () {
    Route::post('admin/posts', [AdminPostController::class, 'store']);
    Route::get('admin/posts/create', [AdminPostController::class, 'create']);
    Route::get('admin/posts/github-create', [GithubController::class, 'create'])->name('posts.github.create');
    Route::post('admin/posts/github-create', [GithubController::class, 'store'])->name('posts.github.store');
    Route::get('admin/posts', [AdminPostController::class, 'index']);
    Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
    Route::patch('admin/posts/{post}', [AdminPostController::class, 'update']);
    Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy']);
});
