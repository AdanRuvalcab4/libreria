<?php

use App\Http\Controllers\RegLibroController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/libro/{tipo_persona?}', [RegLibroController::class, 'formulario']);
Route::post('/registra-libro', [RegLibroController::class, 'newLibro']);
Route::get('lista', [RegLibroController::class, 'lista']);

Route::resource('review', ReviewController::class)->parameters([
    'review' => 'review'
]);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
