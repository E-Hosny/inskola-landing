<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\RobotsController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/refund-policy', [HomeController::class, 'refundPolicy'])->name('refund');
Route::post('/contact', [HomeController::class, 'storeContact'])->name('contact.store');
Route::get('/language/{locale}', [HomeController::class, 'switchLanguage'])->name('language.switch');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [RobotsController::class, 'index'])->name('robots');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/contacts', [AdminController::class, 'index'])->name('admin.contacts')->middleware('auth');
    Route::patch('/contacts/{contact}', [AdminController::class, 'update'])->name('admin.contacts.update')->middleware('auth');
    Route::delete('/contacts/{contact}', [AdminController::class, 'destroy'])->name('admin.contacts.destroy')->middleware('auth');

    Route::middleware('auth')->group(function () {
        Route::get('/articles', [AdminArticleController::class, 'index'])->name('admin.articles.index');
        Route::get('/articles/create', [AdminArticleController::class, 'create'])->name('admin.articles.create');
        Route::post('/articles', [AdminArticleController::class, 'store'])->name('admin.articles.store');
        Route::get('/articles/{article}/edit', [AdminArticleController::class, 'edit'])->name('admin.articles.edit');
        Route::put('/articles/{article}', [AdminArticleController::class, 'update'])->name('admin.articles.update');
        Route::delete('/articles/{article}', [AdminArticleController::class, 'destroy'])->name('admin.articles.destroy');
    });
});

// Redirect 'login' route to admin login (for auth middleware)
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');
