<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [HomeController::class, 'storeContact'])->name('contact.store');
Route::get('/language/{locale}', [HomeController::class, 'switchLanguage'])->name('language.switch');
