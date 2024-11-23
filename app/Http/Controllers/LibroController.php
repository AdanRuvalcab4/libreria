<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;


class LibroController extends Controller 
{
    /*public static function middleware(): array
    {
        return [
            // 'auth',
            new Middleware('auth', except: ['index', 'show']),
            // new Middleware('subscribed', only: ['store']),
        ];
    }*/

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $libros = Libro::all();
        return view('libros.index-libros', compact('libros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('libros.create-libro');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos
        $validated = $request->validate([
            'nombre' => 'required|min:3|max:50',
            'autor' => 'required|min:3|max:50',
            'precio' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:1',
            'descripcion' => 'required|min:3|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Manejar la imagen si existe
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('imagenes_libros', 'public');
            $validated['imagen'] = $path; // Asignamos la ruta final al array de validación
        }

        // Crear el libro con los datos validados
        Libro::create($validated);

        return view('libros.index-libro', compact('libro'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Libro $libro)
    {
        return view('libros.show-libro', compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Libro $libro)
    {
        return view('libros.edit-libro', compact('libro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Libro $libro)
    {
        $request->validate([
           'nombre' => 'required|min:3|max:50', // Máximo ajustado para nombres más largos
            'autor' => 'required|min:3|max:50', // Máximo ajustado para nombres de autores
            'precio' => 'required|numeric|min:0.01', // Asegura un número decimal positivo
            'stock' => 'required|integer|min:1', // Asegura un número entero positivo
            'descripcion' => 'required|min:3|max:255', // Permite descripciones más largas
        ]);

        $libro->update($request->all());

        return redirect()->route('libro.show', $libro);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Libro $libro)
    {
        $libro->delete();
        return redirect()->route('libro.index');
    }

}
