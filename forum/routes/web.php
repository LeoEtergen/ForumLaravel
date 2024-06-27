<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;

Route::match(['get', 'post'], 'login',  [AuthController::class, 'loginUser'])->name('login');
Route::get('/logout', [AuthController::class, 'logoutUser'])->name('logout');
Route::match(['get', 'post'], 'register',  [userController::class, 'registerUser'])->name('register');

Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'listAllUsers'])->name('listAllUsers');
    Route::get('/users/{uid}', [UserController::class, 'listUser'])->name('listUser');
    Route::put('/users/{uid}/update', [UserController::class, 'updateUser'])->name('updateUser');
    Route::delete('/users/{uid}/delete', [UserController::class, 'deletetUser'])->name('deleteUser');

    Route::get('/postagem/postagens', [PostController::class, 'index'])->name('postagem.postagens.index');
    Route::get('/postagem/create', [PostController::class, 'create'])->name('postagem.create');
    Route::post('/postagem/store', [PostController::class, 'store'])->name('postagem.store');
});
Route::get('/', [HomeController::class, 'index']);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/postagens/{id}/edit', [PostController::class, 'edit'])->name('postagem.edit');
Route::put('/postagens/{id}', [PostController::class, 'updatePost'])->name('postagem.update');
Route::put('/postagem/{id}', [PostController::class, 'updatePost'])->name('postagem.update');

Route::get('/tags', [TagController::class, 'index'])->name('tag.index');
Route::get('/tags/create', [TagController::class, 'create'])->name('tag.create');
Route::post('/tags', [TagController::class, 'store'])->name('tag.store');
Route::get('/tags/{tag}', [TagController::class, 'show'])->name('tag.show');
Route::get('/postagens/tag/{tag}', [PostController::class, 'showPostagensByTag'])->name('postagem.tag');
Route::get('/postagens', [PostController::class, 'index'])->name('postagem.index');
Route::post('/postagens', [PostController::class, 'store'])->name('postagem.store');
Route::delete('/postagem/{id}', [PostController::class, 'destroy'])->name('postagem.destroy');
Route::get('/postagens/{id}', [PostController::class, 'show'])->name('postagem.show');




