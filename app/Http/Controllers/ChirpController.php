<?php

namespace App\Http\Controllers;
use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Simulated chirps data    
         $chirps = Chirp::with ('user')
         ->latest()
         ->take(50)
         ->get();
       return view('home', ['chirps' => $chirps]); 

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
    public function store(Request $request)
    {
        //validate the request
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ], [
            'message.required' => 'Please enter a message for your chirp.',
            'message.max' => 'Your chirp message is too long. Maximum 255 characters allowed.',
        ]); 

        //Create the chirp( no user for now - we'll add auth later)
        Chirp::create([
            'message' => $validated['message'],
        ]);

        //Redirect back to the chirps list
        return redirect('/')->with('success', 'Your Chirp has been posted successfully!');   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
        return view('chirps.edit',compact('chirp'));

    }   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        //validate
        $validated = $request->validate([
            'message'=>'required|string|max:255',
        ]);

        //Update the chirp
        $chirp->update($validated);
        
        return redirect('/')->with('success','Chirp updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //Authorize the delete action
       // this->authorize('delete', $chirp);
        $chirp->delete();
        return redirect('/')->with('success','Chirp deleted!');

    }
}
