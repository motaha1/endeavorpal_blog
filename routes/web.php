<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


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

Route::get('/',[PagesController::class ,'index' ]);

Route::get('/about', function () {
    return view('about');
});


Auth::routes() ; 


Route::resource('/blog', PostsController::class);
Route::resource('/comment', CommentController::class);
Route::post('/blog/{post}/toggle', [PostsController::class, 'toggleActivation'])->name('posts.toggleActivation');

Route::post('/comment/{comment}/toggleActivation', 'CommentController@toggleCommentActivation')->name('comment.toggleActivation');
Route::put('/comments/{comment}/toggleActivation', [CommentController::class, 'toggleActivation'])
    ->name('comments.toggleActivation');












