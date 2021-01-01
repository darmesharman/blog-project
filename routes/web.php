<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return redirect()->route('articles.index');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home.index');

// Route::get('articles/', [ArticleController::class, 'index'])->name('article.index');

Route::resource('articles', ArticleController::class);
Route::resource('comments', CommentController::class);
Route::resource('categories', CategoryController::class);
Route::resource('users', UserController::class);

