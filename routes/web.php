<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;

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

Route::get('/', HomeController::class)->name('home');

Route::get('/login', function () {
    return view('auth.login');
});

//Rutas para el registro de usuarios
Route::get('/register', [RegisterController::class,'index'])->name('register.index');
Route::post('/register', [RegisterController::class,'store'])->name('register.store');

//Rutas para el login
Route::get('/login',[LoginController::class,'index'])->name('login'); //login.index
Route::post('/login',[LoginController::class,'store']);

//Rutas para el perfil
Route::get('/profile/edit',[ProfileController::class,'index'])->name('profile.index');
Route::post('/profile/edit',[ProfileController::class,'store'])->name('profile.store');

//Rutas para el muro
Route::get('/{user:username}',[PostController::class,'index'])->name('post.index'); //Route model binding
Route::get('/posts/create',[PostController::class,'create'])->name('post.create');
Route::post('/posts',[PostController::class,'store'])->name('post.store');
Route::get('/{user:username}/posts/{post}',[PostController::class, 'show'])->name('post.show');
Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('post.destroy');

//Rutas para los comentarios
Route::post('/{user:username}/posts/{post}',[CommentController::class, 'store'])->name('comment.store');

//Rutas para el logout
Route::post('/logout',[LogoutController::class,'store'])->name('logout');

//Rutas para imagenes
Route::post('/image',[ImageController::class,'store'])->name('image.store');

//Rutas para los Likes
Route::post('/posts/{post}/likes',[LikeController::class,'store'])->name('post.like.store');
Route::delete('/posts/{post}/likes',[LikeController::class,'destroy'])->name('post.like.destroy');

//Rutas para los followers
Route::post('/{user:username}/follow',[FollowerController::class,'store'])->name('user.follow');
Route::delete('/{user:username}/unfollow',[FollowerController::class,'destroy'])->name('user.unfollow');


