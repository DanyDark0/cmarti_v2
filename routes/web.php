<?php

use App\Http\Controllers\actividadesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BuscadorController;
use App\Http\Controllers\convocatoriasController;
use App\Http\Controllers\directorioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/historia', function() {
    return view('historia');
})->name('historia');

Route::get('/biografia', function() {
    return view('josemarti');
})->name('biografia');

Route::get('/galeria', function() {
    return view('galeria.index');
})->name('galeria');

Route::get('/documentos', function() {
    return view('documentos.index');
})->name('documentos');

Route::get('/convocatorias', function() {
    return view('convocatorias.index');
})->name('convocatorias');

//ruta de la vista actividades
// Route::get('/actividades', function () {
//     return view('actividades');
// })->name('actividades');

//rutas del CRUD de actividades 
Route::get('/actividades/admin', [actividadesController::class, 'admin'])->name('actividades.admin');
 Route::get('/actividades', [actividadesController::class, 'index'])->name('actividades');
 Route::get('/actividades/crear', [actividadesController::class, 'create'])->name('actividades.create');
 Route::post('/actividades', [actividadesController::class, 'store'])->name('actividades.store');
 Route::get('/actividades/{slug}', [actividadesController::class, 'show'])->name('actividades.show');
 Route::get('/actividades/{slug}/editar', [actividadesController::class, 'edit'])->name('actividades.edit');
 Route::put('/actividades/{slug}', [actividadesController::class, 'update'])->name('actividades.update');
 Route::delete('/actividades/{slug}', [actividadesController::class, 'destroy'])->name('actividades.destroy');

 //Rutas del CRUD de directorio
 Route::get('/directorio/admin', [directorioController::class, 'admin'])->name('directorio.admin');
 Route::get('/directorio', [directorioController::class, 'index'])->name('directorio.index');
 Route::get('/directorio/crear', [directorioController::class, 'create'])->name('directorio.create');
 Route::post('/directorio', [directorioController::class, 'store'])->name('directorio.store');
 Route::get('/directorio/{id}/editar', [directorioController::class, 'edit'])->name('directorio.edit');
 Route::put('/directorio/{id}', [directorioController::class, 'update'])->name('directorio.update');
 Route::delete('/directorio/{id}', [directorioController::class, 'destroy'])->name('directorio.destroy');

//Rutas del CRUD de convocatorias
Route::get('/convocatorias', [convocatoriasController::class, 'index'])->name('convocatorias');
Route::get('/convocatorias/admin', [convocatoriasController::class, 'admin'])->name('convocatorias.admin');
Route::get('/convocatorias/crear', [convocatoriasController::class, 'create'])->name('convocatorias.create');
Route::post('/convocatorias', [convocatoriasController::class, 'store'])->name('convocatorias.store');
Route::get('/convocatorias/{slug}', [convocatoriasController::class, 'show'])->name('convocatorias.show');
Route::get('/convocatorias/{slug}/editar', [convocatoriasController::class, 'edit'])->name('convocatorias.edit');
Route::put('/convocatorias/{slug}', [convocatoriasController::class, 'update'])->name('convocatorias.update');
Route::delete('/convocatorias/{slug}', [convocatoriasController::class, 'destroy'])->name('convocatorias.destroy');

 //ruta del buscador
Route::post('/buscador', [BuscadorController::class, 'search'])->name('buscador');

 //Middleware de autentificación 
 Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');

    // Rutas del perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [UserController::class, 'register']);
});