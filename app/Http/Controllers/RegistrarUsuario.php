<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class RegistrarUsuario extends Controller
{
    public function formularioUsuario ($tipo_persona = null) {
        
        return view('registrar-usuario', compact('tipo_persona'));

    }

    public function newUsuario (Request $request) {
        // dd($request->all(), $request->nombre);
        $request->validate([
            'nombre' => 'required|string|min:3|max:255',
            'correo' => 'required|email',
            'password' => 'required|integer|min:6',
        ]);
    
        $usuario = new Usuario();
        $usuario->nombre = $request->nombre;
        $usuario->correo = $request->correo;
        $usuario->password = $request->password;
        $usuario->save();
    
        return redirect('/lista-usuarios');
    }

    public function listaUsuarios()
    {
        $usuario = Usuario::all();
        // dd($mensajes);
        return view('lista-usuarios', compact('usuario'));
        // return view('lista', ['mensajes' => $mensajes]);
        // return view('lista', ['mensajes' => Contacto::all()]);
    }
}
