<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\BooksController::class, 'index'])->name('books');
Route::post('/book', [App\Http\Controllers\BooksController::class, 'store'])->name('book.store');
