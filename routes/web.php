<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|------------------------------------------------------------------------------------------------------------------------------------------
| Web Routes
|------------------------------------------------------------------------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute untuk halaman home
Route::get('/', function () {
    return view('home');
});

// Rute untuk buku
Route::prefix('/book')->name('book.')->group(function() {
    Route::get('/create', [BookController::class, 'create'])->name('create');
    Route::post('/store', [BookController::class, 'store'])->name('store');
    Route::get('/data', [BookController::class, 'index'])->name('home');
    Route::get('/{id}', [BookController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [BookController::class, 'update'])->name('update');
    Route::delete('/{id}', [BookController::class, 'destroy'])->name('destroy');
});

// Rute untuk akun pengguna
Route::prefix('/akun')->name('akun.')->group(function() {
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/data', [UserController::class, 'index'])->name('home');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit'); 
    Route::patch('/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('delete');
});

