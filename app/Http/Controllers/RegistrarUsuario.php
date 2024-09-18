<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class RegistrarUsuario extends Controller
{
    public function usuario ($tipo_persona = null) {
        
        return view('registrar-libro', compact('tipo_persona'));

    }
}
