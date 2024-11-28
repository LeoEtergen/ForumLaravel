<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, 'HomeForum'])->name('home');


Route::get('/', [AuthController::class, 'teste'])->name('teste');
Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');
Route::match(['get', 'post'], '/register', [UserController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    // User routes
    Route::get('/users', [UserController::class, 'listAllUsers'])->name('listAllUsers');
    Route::get('/users/{id}', [UserController::class, 'listUserById'])->name('listUserById');
    Route::put('/users/{id}/update', [UserController::class, 'updateUser'])->name('updateUser');
    Route::delete('/users/{id}/delete', [UserController::class, 'deleteUser'])->name('deleteUser');


    // Post routes
    Route::get('/posts', [PostController::class, 'listAllPosts'])->name('listAllPosts');  // Exibe todos os posts
    Route::get('/posts/create', [PostController::class, 'createPost'])->name('createPost'); // Exibe o formulário de criação de post
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); // Armazena o novo post
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');  // Exibe post
    Route::get('/posts/{id}/edit', [PostController::class, 'editPost'])->name('editPost');  // Edita post
    Route::put('/posts/{id}', [PostController::class, 'updatePost'])->name('updatePost');  // Atualiza post
    Route::delete('/posts/{id}', [PostController::class, 'deletePost'])->name('deletePost');  // Exclui post

    // comment
    Route::prefix('topics/{topicId}/comments')->group(function () {
        Route::get('/', [CommentController::class, 'index'])->name('comments.index');
        Route::get('/{id}', [CommentController::class, 'show'])->name('comments.show');
        Route::get('/create', [CommentController::class, 'create'])->name('comments.create');
        Route::post('/', [CommentController::class, 'store'])->name('comments.store');
        Route::get('/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
        Route::put('/{id}', [CommentController::class, 'update'])->name('comments.update');
        Route::delete('/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    });



    // Topic routes
    Route::get('/topics', [TopicController::class, 'listAllTopics'])->name('topics.listAllTopics');
    Route::get('/topics/create', [TopicController::class, 'createTopicForm'])->name('topics.create');
    Route::post('/topics', [TopicController::class, 'storeTopic'])->name('storeTopic');
    Route::get('/topics/{id}/edit', [TopicController::class, 'editTopicForm'])->name('topics.edit');
    Route::put('/topics/{id}', [TopicController::class, 'updateTopic'])->name('topics.update');
    Route::delete('/topics/{id}', [TopicController::class, 'deleteTopic'])->name('topics.delete');
    Route::get('/topics/{id}', [TopicController::class, 'showTopic'])->name('listTopicById');

    // Tag routes
    Route::get('/tags/create', [TagController::class, 'createTag'])->name('createTag');
    Route::get('/tags', [TagController::class, 'listAllTags'])->name('listAllTags');
    Route::get('/tags/{id}', [TagController::class, 'listTagById'])->name('listTagById');
    Route::put('/tags/{id}/update', [TagController::class, 'updateTag'])->name('updateTag');
    Route::delete('/tags/{id}/delete', [TagController::class, 'deleteTag'])->name('deleteTag');
    Route::post('/tags', [TagController::class, 'storeTag'])->name('storeTag');

    // Category routes
    Route::get('/categories', [CategoryController::class, 'listAllCategories'])->name('listAllCategories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('createCategory');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}', [CategoryController::class, 'listCategoryById'])->name('listCategoryById');
    Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('editCategory');
    Route::delete('categories/{id}', [CategoryController::class, 'delete'])->name('deleteCategory');
    Route::delete('/categories/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
    Route::put('/categories/{id}', [CategoryController::class, 'updateCategory'])->name('categories.update');
    Route::get('/categories/{id}/posts', [CategoryController::class, 'showPostsByCategory'])->name('posts.showByCategory');

    // suspension user
    Route::middleware(['auth', 'chack.suspension'])->group(function () {
        Route::post('/categories/{category}/suspension', [CategoryController::class, 'suspend'])->name('categories.suspend');
        Route::post('/tags/{tag}/suspension', [TagController::class, 'suspend'])->name('tags.suspend');
        Route::post('/topics/{topic}/suspension', [TopicController::class, 'suspend'])->name('topics.suspend');
        Route::post('/posts/{post}/suspension', [PostController::class, 'suspend'])->name('posts.suspend');
        Route::post('/users/{user}/suspension', [UserController::class, 'suspend'])->name('users.suspend');
    });
});
