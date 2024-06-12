<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Creator\PostController;
use App\Http\Controllers\Creator\AllPostController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Public\PublicPostController;
use App\Http\Controllers\Public\FavoritePostController;

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

        // Manage User
        Route::resource('users', ManageUserController::class)->parameters(['users' => 'user:username']);
        });

    // Middleware Creator
    Route::group(['middleware' => 'role:creator', 'prefix' => 'creator', 'as' => 'creator.'], function() {
        // Testing Page
        // Route::get('/creators', function () {
        //     return view('creator.users.index', ['title' => 'This Is Creator']);
        // })->name('users.index');

        // Manage Post
        Route::resource('posts', PostController::class)->parameters(['posts' => 'post:slug']);
        Route::get('/posts/category/{category:slug}', [PostController::class, 'show_by_category'])->name('posts.show.category');
        Route::get('/posts/company/{company:slug}', [PostController::class, 'show_by_company'])->name('posts.show.company');

        // Show All Post
        Route::resource('all-posts', AllPostController::class)->parameters(['all-posts' => 'post:slug']);
        Route::get('/all-posts/creator/{creator:username}', [AllPostController::class, 'show_by_creator'])->name('all-posts.show.creator');
        Route::get('/all-posts/category/{category:slug}', [AllPostController::class, 'show_by_category'])->name('all-posts.show.category');
        Route::get('/all-posts/company/{company:slug}', [AllPostController::class, 'show_by_company'])->name('all-posts.show.company');
        });

    // Middleware Public
    Route::group(['middleware' => 'role:public', 'prefix' => 'public', 'as' => 'public.'], function() {
        // Testing Page
        // Route::get('/publics', function () {
        //     return view('public.users.index', ['title' => 'This Is Public']);
        // })->name('users.index');

        // Show Post
        Route::resource('posts', PublicPostController::class)->parameters(['posts' => 'post:slug']);
        Route::get('/posts/category/{category:slug}', [PublicPostController::class, 'show_by_category'])->name('posts.show.category');
        Route::get('/posts/company/{company:slug}', [PublicPostController::class, 'show_by_company'])->name('posts.show.company');
        Route::get('/posts/show/{post:slug}/like', [PublicPostController::class, 'like'])->name('posts.like');
        Route::get('/posts/show/{post:slug}/unlike', [PublicPostController::class, 'unlike'])->name('posts.unlike');

        // Show Favorite Post
        Route::resource('favorite-posts', FavoritePostController::class)->parameters(['favorite-posts' => 'post:slug']);
        Route::get('/favorite-posts/category/{category:slug}', [FavoritePostController::class, 'show_by_category'])->name('favorite-posts.show.category');
        Route::get('/favorite-posts/company/{company:slug}', [FavoritePostController::class, 'show_by_company'])->name('favorite-posts.show.company');
        Route::get('/favorite-posts/show/{post:slug}/like', [FavoritePostController::class, 'like'])->name('favorite-posts.like');
        Route::get('/favorite-posts/show/{post:slug}/unlike', [FavoritePostController::class, 'unlike'])->name('favorite-posts.unlike');
        });
});
