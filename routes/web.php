<?php

use App\Http\Controllers\LibroController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Recursos RESTful
Route::resource('review', ReviewController::class)->parameters([
    'review' => 'review'
]);

Route::resource('order', OrderController::class)->parameters([
    'order' => 'order'
]);

Route::resource('libro', LibroController::class)->parameters([
    'libro' => 'libro'
]);

// Rutas adicionales para libros
Route::get('/libros/create', [LibroController::class, 'create'])->name('libros.create');
Route::get('/libros/{id}/edit', [LibroController::class, 'edit'])->name('edit-libro');
Route::delete('/libros/{id}', [LibroController::class, 'destroy'])->name('libros.destroy');

// Ruta para el dashboard (ahora sin autenticación)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Rutas para índices
Route::get('/libros', [LibroController::class, 'index'])->name('index-libros');
Route::get('/orders', [OrderController::class, 'index'])->name('index-orders');
Route::get('/reviews', [ReviewController::class, 'index'])->name('index-reviews');

// Añadir la ruta para crear reseñas
Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::get('/orders', [OrderController::class, 'index'])->name('index-orders');
Route::get('/orders', [OrderController::class, 'index'])->name('index-orders');
Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
Route::resource('reviews', 'ReviewController');
Route::get('/reviews', 'ReviewController@index')->name('index-reviews');
Route::resource('reviews', 'ReviewController');

Route::resource('reviews', ReviewController::class);
Route::get('/index-reviews', [ReviewController::class, 'index'])->name('index-reviews');
Route::resource('libros', LibroController::class);
Route::get('/index-libros', [LibroController::class, 'index'])->name('index-libros');
Route::resource('orders', OrderController::class);
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

Route::get('/orders', [OrderController::class, 'index'])->name('index-orders');

