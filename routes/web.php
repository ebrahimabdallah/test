<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/blog/{slug}', [WelcomeController::class, 'showBlog'])
    ->where('slug', '[^/]+')
    ->name('blog.show');
