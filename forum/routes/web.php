<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;


Route::match(
    ['get', 'post'],
    '/login',
    [AuthController::class, 'loginUser']
)->name('login');

Route::get(
    '/logout',
    [AuthController::class, 'logoutUser']
)->name('logout');

Route::match(
    ['get', 'post'],
    '/register',
    [UserController::class, 'registerUser']
)->name('register');

Route::middleware('auth')->group(function () {
    Route::get(
        '/users',
        [UserController::class, 'listAllUsers']
    )->name('ListAllUsers');

    Route::get(
        '/users/{uid}',
        [UserController::class, 'listUser']
    )->name('ListUser');

    Route::put(
        '/users/{uid}/update',
        [UserController::class, 'updateUser']
    )->name('UpdateUser');

    Route::delete(
        '/users/{uid}/delete',
        [UserController::class, 'deleteUser']
    )->name('DeleteUser');
});

//rota categorias
Route::resource('categories', CategoryController::class);

//rota tags
Route::resource('tags', TagController::class);
