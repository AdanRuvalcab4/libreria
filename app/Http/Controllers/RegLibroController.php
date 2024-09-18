<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class RegLibroController extends Controller
{
    public function formulario ($tipo_persona = null) {
        
        return view('registrar-libro', compact('tipo_persona'));

    }

    public function newLibro (Request $request) {
        // dd($request->all(), $request->nombre);
        $request->validate([
            'nombre' => 'required|string|min:3|max:255',
            'autor' => 'required|string|min:3|max:255',
            'precio' => 'required|integer|min:3',
            'stock' => 'required|integer|min:4',
            'descripcion' => ['required', 'min:10']
        ]);
    
        $libro = new Libro();
        $libro->nombre = $request->nombre;
        $libro->autor = $request->autor;
        $libro->precio = $request->precio;
        $libro->stock = $request->stock;
        $libro->descripcion =$request->descripcion;
        $libro->save();
    
        return redirect('/lista');
    }
    
    public function lista ()
    {
        $libro = Libro::all();
        // dd($mensajes);
        return view('lista', compact('libro'));
        // return view('lista', ['mensajes' => $mensajes]);
        // return view('lista', ['mensajes' => Contacto::all()]);
    }

}
