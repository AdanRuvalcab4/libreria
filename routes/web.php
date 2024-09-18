<?php

use App\Http\Controllers\RegLibroController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/libro/{tipo_persona?}', [RegLibroController::class, 'formulario']);
Route::post('/registra-libro', [RegLibroController::class, 'newLibro']);
Route::get('lista', [RegLibroController::class, 'lista']);