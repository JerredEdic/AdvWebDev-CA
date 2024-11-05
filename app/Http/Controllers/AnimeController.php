<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animes = Anime::all();
        return view('animes.index', compact('animes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("animes.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // Validate input 
        $request->validate([
            'title' => 'required',
            'description' => 'required|max:500',
            'numberOfEp' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // Check if the image is uploaded and handle it
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move (public_path('images'), $imageName);
        }
        // Create a anime record in the database
        Anime::create([
        'title' => $request->title,
        'description' => $request->description, // Fixed typo from 'descriptn' 
        'numberOfEp' => $request->numberOfEp,
        'image' => 'images/'.$imageName, // Store the image URL in the DB
        'created_at' => now(),
        'updated_at' => now()
        ]);
        // Redirect to the index page with a success message
        return_to_route('animes.index')->with('success', 'Anime created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Anime $anime)
    {
        return view('animes.show')->with('anime',$anime);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anime $anime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anime $anime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anime $anime)
    {
        //
    }
}
