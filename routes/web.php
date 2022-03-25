<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', function () { return view('home');});

Route::resource('post', PostController::class)->except('create');

Route::resource('about', AboutController::class)->except('create');

Route::resource('category', CategoryController::class)->except('create');

Route::post('comment/{id}',[CommentController::class, 'answerComment'])->name('answer.comment');

Route::resource('comment', CommentController::class)->except('create','index','show');
