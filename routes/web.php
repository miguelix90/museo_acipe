<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExposicionController;
use App\Http\Controllers\Admin\SalaController;
use App\Http\Controllers\Admin\LibroController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\MuseoController;
use Illuminate\Support\Facades\Route;

// Rutas públicas del museo
Route::get('/', [MuseoController::class, 'index'])->name('museo.home');
Route::get('/exposiciones', [MuseoController::class, 'exposiciones'])->name('museo.exposiciones');
Route::get('/salas', [MuseoController::class, 'salas'])->name('museo.salas');
Route::get('/libros', [MuseoController::class, 'libros'])->name('museo.libros');
Route::get('/acerca-de', [MuseoController::class, 'acerca'])->name('museo.acerca');

// Rutas legales (cookies, privacidad, etc.)
Route::view('/cookies/politica', 'cookies.politica')->name('cookies.politica');
Route::view('/cookies/configurar', 'cookies.configurar')->name('cookies.configurar');

Route::get('/exposicion/{slug}', [MuseoController::class, 'exposicion'])->name('museo.exposicion');
Route::get('/exposicion/{exposicion_slug}/sala/{sala_slug}', [MuseoController::class, 'sala'])->name('museo.sala');
Route::get('/libro/{id}', [MuseoController::class, 'libro'])->name('museo.libro');

// Rutas de autenticación de Breeze
require __DIR__.'/auth.php';

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas del panel de administración (requiere rol admin o superior)
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        
        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // CRUD Exposiciones
        Route::resource('exposiciones', ExposicionController::class)->parameters([
            'exposiciones' => 'exposicion'
        ]);
        
        // CRUD Salas
        Route::resource('salas', SalaController::class)->parameters([
            'salas' => 'sala'
        ]);
        
        // CRUD Libros
        Route::resource('libros', LibroController::class);
        
        // CRUD Usuarios (solo superadmin)
        Route::middleware('superadmin')->group(function () {
            Route::resource('users', UserController::class);
        });
    });
