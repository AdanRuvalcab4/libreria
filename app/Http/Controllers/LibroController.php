<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $libros = Libro::all();
        return view('libros.index-libros', compact('libros'));
    }

    public function create()
    {
        return view('libros.create-libro');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|min:3|max:50',
            'autor' => 'required|min:3|max:50',
            'precio' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:1',
            'descripcion' => 'required|min:3|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('imagenes_libros', 'public');
            $validated['imagen'] = $path;
        }

        Libro::create($validated);

        return redirect()->route('libros.index');
    }

    public function show(Libro $libro)
    {
        return view('libros.show-libro', compact('libro'));
    }

    public function edit(Libro $libro)
    {
        return view('libros.edit-libro', compact('libro'));
    }

    public function update(Request $request, Libro $libro)
    {
        $request->validate([
           'nombre' => 'required|min:3|max:50',
            'autor' => 'required|min:3|max:50',
            'precio' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:1',
            'descripcion' => 'required|min:3|max:255',
        ]);

        $libro->update($request->all());

        return redirect()->route('libros.show', $libro);
    }

    public function destroy(Libro $libro)
    {
        // Eliminar el libro
        $libro->delete();

        // Redirigir de vuelta con un mensaje
        return redirect()->route('libros.index')->with('success', 'Libro eliminado correctamente');
    }
}
