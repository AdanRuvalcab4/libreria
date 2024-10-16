<?php

namespace App\Http\Controllers;

use App\Models\Review;
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
        $reviews = Review::all();
        return view('reviews.index-reviews', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reviews.create-review');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([]);
        Review::create($request->all());

        return redirect()->route('review.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return view('reviews.show-review', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        return view('reviews.edit-review', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $review->update($request->all());

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
