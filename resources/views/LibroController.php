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
        $request->validate([
            'nombre' => 'required|min:3|max:20',
            'autor' => 'required|min:3|max:15',
            'precio' => 'required|integer',
            'stock' => 'required|integer',
            'descripcion' => ['required', 'min:10'],
        ]);
        Libro::create($request->all());

        return redirect()->route('libro.index');
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
            'nombre' => 'required|min:3|max:20',
            'autor' => 'required|min:3|max:15',
            'precio' => 'required|integer',
            'stock' => 'required|integer',
            'descripcion' => ['required', 'min:10'],
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
