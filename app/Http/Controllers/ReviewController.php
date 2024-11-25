<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Libro;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $reviews = Review::with(['user', 'libro'])->get();
        return view('reviews.index-reviews', compact('reviews'));
    }

    public function create()
    {
        $libros = Libro::all();
        return view('reviews.create-review', compact('libros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'libro_id' => 'required|exists:libros,id',
            'titulo' => 'required|string|max:255',
            'review' => 'required|string',
            'fecha' => 'required|date',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'libro_id' => $request->libro_id,
            'titulo' => $request->titulo,
            'review' => $request->review,
            'fecha' => $request->fecha,
        ]);

        return redirect()->route('reviews.index');
    }

    public function show(Review $review)
    {
        return view('reviews.show-review', compact('review'));
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $libros = Libro::all();
        return view('reviews.edit-review', compact('review', 'libros'));
    }

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

        return redirect()->route('reviews.show', $review);
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('reviews.index');
    }
}
