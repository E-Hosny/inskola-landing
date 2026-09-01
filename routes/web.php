<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/refund-policy', [HomeController::class, 'refundPolicy'])->name('refund');
Route::post('/contact', [HomeController::class, 'storeContact'])->name('contact.store');
Route::get('/language/{locale}', [HomeController::class, 'switchLanguage'])->name('language.switch');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/contacts', [AdminController::class, 'index'])->name('admin.contacts')->middleware('auth');
    Route::patch('/contacts/{contact}', [AdminController::class, 'update'])->name('admin.contacts.update')->middleware('auth');
    Route::delete('/contacts/{contact}', [AdminController::class, 'destroy'])->name('admin.contacts.destroy')->middleware('auth');
});

// Redirect 'login' route to admin login (for auth middleware)
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');
