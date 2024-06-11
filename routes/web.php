<?php

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Creator\AllPostController;
use App\Http\Controllers\Creator\PostController;

Route::get('/', function () {
    return view('welcome', ['title' => 'This Is Home']);
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ['title' => 'This Is Dashboard']);
    })->name('dashboard');

    // Middleware Admin
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
        // Testing Page
        // Route::get('/users', function () {
        //     return view('admin.users.index', ['title' => 'This Is Admin']);
        // })->name('users.index');

        Route::resource('users', ManageUserController::class)->parameters(['users' => 'user:username']);
        });

    // Middleware Creator
    Route::group(['middleware' => 'role:creator', 'prefix' => 'creator', 'as' => 'creator.'], function() {
        // Testing Page
        // Route::get('/creators', function () {
        //     return view('creator.users.index', ['title' => 'This Is Creator']);
        // })->name('users.index');

        Route::resource('posts', PostController::class)->parameters(['posts' => 'post:slug']);
        Route::get('/posts/category/{category:slug}', [PostController::class, 'show_by_category'])->name('posts.show.category');
        Route::get('/posts/company/{company:slug}', [PostController::class, 'show_by_company'])->name('posts.show.company');

        Route::resource('all-posts', AllPostController::class)->parameters(['all-posts' => 'post:slug']);
        Route::get('/all-posts/creator/{creator:username}', [AllPostController::class, 'show_by_creator'])->name('all-posts.show.creator');
        Route::get('/all-posts/category/{category:slug}', [AllPostController::class, 'show_by_category'])->name('all-posts.show.category');
        Route::get('/all-posts/company/{company:slug}', [AllPostController::class, 'show_by_company'])->name('all-posts.show.company');
        });

    // Middleware Public
    Route::group(['middleware' => 'role:public', 'prefix' => 'public', 'as' => 'public.'], function() {
        // Testing Page
        Route::get('/publics', function () {
            return view('public.users.index', ['title' => 'This Is Public']);
        })->name('users.index');
        });
});
