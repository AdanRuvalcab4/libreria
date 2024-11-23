<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Libro;
use App\Models\User;
use Illuminate\Http\Request;


class ReviewController extends Controller 
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
        $reviews = Review::with(['user', 'libro'])->get();
        return view('reviews.index-reviews', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $libros = Libro::all();
      
        return view('reviews.create-review', compact('libros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        // Validación de los campos
        $request->validate([
            'libro_id' => 'required|exists:libros,id', // Verifica que el libro exista en la tabla libros
            'titulo' => 'required|string|max:255',
            'review' => 'required|string',
            'fecha' => 'required|date',
        ]);

        // Crear la reseña
        Review::create([
            'user_id' => auth()->id(), // Obtiene el ID del usuario autenticado
            'libro_id' => $request->libro_id,
            'titulo' => $request->titulo,
            'review' => $request->review,
            'fecha' => $request->fecha,
        ]);


        return redirect()->route('review.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        $reviews = Review::with(['user', 'libro'])->get();
        return view('reviews.show-review', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $libros = Libro::all();
        return view('reviews.edit-review', compact('review', 'libros'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
        $review = Review::findOrFail($id);

        $request->validate([
            'libro_id' => 'required|exists:libros,id',
            'titulo' => 'required|string|max:255',
            'fecha' => 'required|date',
            'review' => 'required|string|max:2000',
        ]);

        $review->update([
            'libro_id' => $request->libro_id,
            'titulo' => $request->titulo,
            'fecha' => $request->fecha,
            'review' => $request->review,
        ]);


        return redirect()->route('review.show', $review);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('review.index');
    }

}
