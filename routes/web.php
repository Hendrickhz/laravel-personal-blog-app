<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('public.index');
    Route::get('/article/{slug}','show')->name('public.show');
    Route::get('/category/{slug}','categorized')->name('public.categorized');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('articles/trash-bin', [ArticleController::class, 'showTrashBin'])->name('articles.showTrashBin');
Route::get('articles/restore/{id}', [ArticleController::class, 'restore'])->name('articles.restore');
Route::delete('articles/force-delete/{id}', [ArticleController::class, 'forceDelete'])->name('articles.forceDelete');
Route::prefix('dashboard')->group(function(){
    Route::resource('articles', ArticleController::class);
});
Route::resource('categories', CategoryController::class);
Route::resource('tags', TagController::class);
