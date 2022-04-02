<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/create', [HomeController::class, 'createBlock'])->name('create.block');

Route::post('search',[PostController::class, 'search'])->name('search');

Route::resource('post', PostController::class)->except('create','index');

Route::resource('about', AboutController::class)->except('store','show','create','destroy');

Route::resource('category', CategoryController::class)->except('index','create','edit');

Route::post('comment/{post_id}/{comment_id}',[CommentController::class, 'answerComment'])->name('answer.comment');

Route::resource('comment', CommentController::class)->except('create','index','show');
