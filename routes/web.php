<?php

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

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
        Route::get('/users', function () {
            return view('admin.users.index', ['title' => 'This Is Admin']);
        })->name('users.index');
        });

    // Middleware Creator
    Route::group(['middleware' => 'role:creator', 'prefix' => 'creator', 'as' => 'creator.'], function() {
        // Testing Page
        Route::get('/creators', function () {
            return view('creator.users.index', ['title' => 'This Is Creator']);
        })->name('users.index');
        });

    // Middleware Public
    Route::group(['middleware' => 'role:public', 'prefix' => 'public', 'as' => 'public.'], function() {
        // Testing Page
        Route::get('/publics', function () {
            return view('public.users.index', ['title' => 'This Is Public']);
        })->name('users.index');
        });
});
