<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;

// Rota inicial - Página principal do fórum
Route::get('/', [HomeController::class, 'HomeForum'])->name('home');

// Autenticação
Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');
Route::match(['get', 'post'], '/register', [UserController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Grupo de rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    
    // Rotas de Usuários
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'listAllUsers'])->name('listAllUsers');
        Route::get('/{id}', [UserController::class, 'listUserById'])->name('listUserById');
        Route::put('/{id}/update', [UserController::class, 'updateUser'])->name('updateUser');
        Route::delete('/{id}/delete', [UserController::class, 'deleteUser'])->name('deleteUser');
    });

    // Rotas de Posts
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'listAllPosts'])->name('listAllPosts');
        Route::get('/create', [PostController::class, 'createPost'])->name('createPost');
        Route::post('/', [PostController::class, 'store'])->name('posts.store');
        Route::get('/{id}', [PostController::class, 'show'])->name('posts.show');
        Route::get('/{id}/edit', [PostController::class, 'editPost'])->name('editPost');
        Route::put('/{id}', [PostController::class, 'updatePost'])->name('updatePost');
        Route::delete('/{id}', [PostController::class, 'deletePost'])->name('deletePost');
    });

    // Rotas de Tópicos
    Route::prefix('topics')->group(function () {
        Route::get('/', [TopicController::class, 'listAllTopics'])->name('topics.listAllTopics');
        Route::get('/create', [TopicController::class, 'createTopicForm'])->name('topics.create');
        Route::post('/', [TopicController::class, 'storeTopic'])->name('storeTopic');
        Route::get('/{id}', [TopicController::class, 'showTopic'])->name('listTopicById');
        Route::get('/{id}/edit', [TopicController::class, 'editTopicForm'])->name('topics.edit');
        Route::put('/{id}', [TopicController::class, 'updateTopic'])->name('topics.update');
        Route::delete('/{id}', [TopicController::class, 'deleteTopic'])->name('topics.delete');

        // Rotas de Comentários dentro de Tópicos
        Route::prefix('{topicId}/comments')->group(function () {
            Route::post('/', [CommentController::class, 'store'])->name('comments.store');
            Route::put('/{id}', [CommentController::class, 'update'])->name('comments.update');
            Route::delete('/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
        });
    });

    // Rotas de Categorias
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'listAllCategories'])->name('listAllCategories');
        Route::get('/create', [CategoryController::class, 'create'])->name('createCategory');
        Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/{id}', [CategoryController::class, 'listCategoryById'])->name('listCategoryById');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('editCategory');
        Route::put('/{id}', [CategoryController::class, 'updateCategory'])->name('categories.update');
        Route::delete('/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
        Route::get('/{id}/posts', [CategoryController::class, 'showPostsByCategory'])->name('posts.showByCategory');
        Route::get('/{id}/topics', [CategoryController::class, 'showPostsByCategory'])->name('posts.showByCategory');

    });

    // Rotas de Tags
    Route::prefix('tags')->group(function () {
        Route::get('/', [TagController::class, 'listAllTags'])->name('listAllTags');
        Route::get('/create', [TagController::class, 'createTag'])->name('createTag');
        Route::post('/', [TagController::class, 'storeTag'])->name('storeTag');
        Route::get('/{id}', [TagController::class, 'listTagById'])->name('listTagById');
        Route::put('/{id}', [TagController::class, 'updateTag'])->name('updateTag');
        Route::delete('/{id}', [TagController::class, 'deleteTag'])->name('deleteTag');
    });
});
