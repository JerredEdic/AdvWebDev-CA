<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Anime;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Anime $anime)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000'
        ]);

        $anime->reviews()->create([
            'user_id' => auth()->id(),
            'rating' =>$request->input('rating'),
            'comment' => $request->input('comment'),
            'anime_id' => $anime->id
        ]);

        return redirect()->route('animes.show',$anime)->with('success','Review Posted');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        if(auth()->user()->role !== 'admin' && auth()->user()->id!==$review->user_id){
            return redirect()->route('animes.index')->with('error', 'Access denied');
        }

        return view("reviews.edit",compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
