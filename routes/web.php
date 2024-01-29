<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ImagenesController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;

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

// Route::get('/', function () {
//     return view('principal');
// });

Route::get('/', HomeController::class)->name('home');


Route::get('lang/{lang}', function ($lang) {
    app()->setLocale($lang);
    session()->put('locale', $lang);

    // Obtiene la URL actual
    $url = url()->previous();

    return redirect($url);
})->name('lang');

// Route::post('/crear-cuenta', [RegistroController::class, 'index']);
// Modificar usuario
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');

//Crear usuario
Route::get('/crear-cuenta', [RegistroController::class, 'index'])->name('registro');
Route::post('/crear-cuenta', [RegistroController::class, 'store'])->name('crear');

//Inicio sesion
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LogoutController::class, 'store'])->name('logout');



// Creacion de nuevas publicaciones - Eliminacion de publicaciones
Route::get('/{user:username}', [PostController::class, 'index'])->name('post.index');
Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::get('/{user:username}/post/{post}', [PostController::class, 'show'])->name('post.show');
Route::post('/post', [PostController::class, 'store'])->name('post.store');
Route::DELETE('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

//Subir imagen Controller
Route::post('/imagenes', [ImagenesController::class, 'store'])->name('imagenes.store');

// Dar Likes a publicaciones y quitar like a publicaciones
Route::post('/post/{post}/like', [LikeController::class, 'store'])->name('post.like.store');
Route::delete('/post/{post}/like', [LikeController::class, 'destroy'])->name('post.like.destroy');

// Comentar Publicacion
Route::post('/{user:username}/post/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');

//follow unfollow

Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');
