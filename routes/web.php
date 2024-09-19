<?php

use App\Http\Controllers\RegLibroController;
use App\Http\Controllers\RegistrarUsuario;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/libro/{tipo_persona?}', [RegLibroController::class, 'formulario']);
Route::post('/registra-libro', [RegLibroController::class, 'newLibro']);
Route::get('lista', [RegLibroController::class, 'lista']);

Route::get('/usuario/{tipo_persona?}', [RegistrarUsuario::class, 'formularioUsuario']);
Route::post('/registra-usuario', [RegistrarUsuario::class, 'newUsuario']);
Route::get('lista-usuarios', [RegistrarUsuario::class, 'listaUsuarios']);