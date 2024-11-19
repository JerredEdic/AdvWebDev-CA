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
        if (auth()->user()->role !== 'admin'){
            return redirect()->route('animes.index')->with('error', 'Access denied');
        }
        return view("animes.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Use dd() to trouble shoot

        
        // Validate input 
        $request->validate([
            'title'=>'required|string|max:255',
            'description'=>'required|string|max:500',
            'numberOfEp'=>'required|integer',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

  
        // Check if the image is uploaded and handle it
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }
        // Create a anime record in the database
        Anime::create([
        'title'=>$request->title,
        'description'=>$request->description, // Fixed typo from 'descriptn' 
        'numberOfEp'=>$request->numberOfEp,
        'image'=>'images/'.$imageName, // Store the image URL in the DB
        'created_at'=>now(),
        'updated_at'=>now()
        ]);
        // Redirect to the index page with a success message
        return to_route('animes.index')->with('success', 'Anime created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Anime $anime)
    {
        $anime->load('reviews.user');
        return view('animes.show',compact('anime'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anime $anime)
    {
        if (auth()->user()->role !== 'admin'){
            return redirect()->route('animes.index')->with('error', 'Access denied');
        }
        return view("animes.edit", compact('anime'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anime $anime)
    {
        // Validate input 
        $request->validate([
            'title'=>'required|string|max:255',
            'description'=>'required|string|max:500',
            'numberOfEp'=>'required|integer',
            'image'=>'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

  
        // Check if the image is uploaded and handle it
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $anime->update(['image'=>'images/'.$imageName]);// updates the image URL in the DB
        }
        // Update a anime record in the database
        $anime->update([
        'title'=>$request->title,
        'description'=>$request->description, // Fixed typo from 'descriptn' 
        'numberOfEp'=>$request->numberOfEp,
        'updated_at'=>now()
        ]);
        // Redirect to the index page with a success message
        return to_route('animes.index')->with('success', 'Anime edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anime $anime)
    {
        if (auth()->user()->role !== 'admin'){
            return redirect()->route('animes.index')->with('error', 'Access denied');
        }
        
        unlink(public_path($anime->image));
        $anime->delete();
 
        return to_route('animes.index')->with('success', 'Anime deleted successfully!');
    }
}
