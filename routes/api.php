<?php

use App\Http\Controllers\API\PostApiController;
use App\Http\Controllers\API\RepoApiController;
use App\Http\Controllers\API\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/posts', [PostApiController::class, 'index'])->name('post.api.index');
Route::get('/posts/{post:slug}', [PostApiController::class, 'show'])->name('post.api.show');
Route::post('/posts', [PostApiController::class, 'create'])->name('post.api.create');

Route::get('/users', [UserApiController::class, 'index'])->name('user.api.index');
Route::get('/users/{user:username}', [UserApiController::class, 'show'])->name('user.api.show');

Route::get('/repos', [RepoApiController::class, 'index'])->name('repo.api.index');
Route::get('/repos/{github_repos:repo_name}', [RepoApiController::class, 'show'])->name('repo.api.show');
