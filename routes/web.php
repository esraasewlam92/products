<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [CategoryController::class, 'dashboard'])->name('home');

    Route::prefix('category')->group(function () {
        Route::get('create', [CategoryController::class, 'create'])->name('category.create');
        Route::get('{id}', [CategoryController::class, 'show'])->name('category.show');
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::delete('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
        Route::post('/', [CategoryController::class, 'store'])->name('category.store');
        Route::put('{id}', [CategoryController::class, 'update'])->name('category.update');

    });
    Route::prefix('product')->group(function () {
        Route::get('create', [ProductController::class, 'create'])->name('product.create');
        Route::get('{id}', [ProductController::class, 'show'])->name('product.show');
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::get('{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/', [ProductController::class, 'store'])->name('product.store');
        Route::put('{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('delete/{id}', [ProductController::class, 'delete'])->name('product.delete');


    });
});
