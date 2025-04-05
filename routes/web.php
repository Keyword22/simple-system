<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Settings\LocaleController;
use App\Http\Controllers\Content\PostController;
use App\Models\Post;
use App\Http\Controllers\NewsletterController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'featuredPosts' => Post::latest()
                              ->select(['id', 'title', 'excerpt', 'image', 'published_at'])
                              ->take(10)
                              ->get()
    ]);
    
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/locale', [LocaleController::class, 'update'])->name('locale.update');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';


Route::resource('posts', App\Http\Controllers\Content\PostController::class)->only('index', 'store');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show');
