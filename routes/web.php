<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

//Rutas para el registro de usuarios
Route::get('/register', [RegisterController::class,'index'])->name('register.index');
Route::post('/register', [RegisterController::class,'store'])->name('register.store');

//Rutas para el login
Route::get('/login',[LoginController::class,'index'])->name('login'); //login.index
Route::post('/login',[LoginController::class,'store']);

//Rutas para el muro
Route::get('/{user:username}',[PostController::class,'index'])->name('post.index'); //Route model binding
Route::get('/posts/create',[PostController::class,'create'])->name('post.create');
Route::post('/posts',[PostController::class,'store'])->name('post.store');
Route::get('/{user:username}/posts/{post}',[PostController::class, 'show'])->name('post.show');

//Rutas para los comentarios
Route::post('/{user:username}/posts/{post}',[CommentController::class, 'store'])->name('comment.store');

//Rutas para el logout
Route::post('/logout',[LogoutController::class,'store'])->name('logout');

//Rutas para imagenes
Route::post('/image',[ImageController::class,'store'])->name('image.store');