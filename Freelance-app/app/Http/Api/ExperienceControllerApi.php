<?php

namespace App\Http\Api;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $experiences = Experience::where('freelance_id', auth::user()->freelance->id)->get();
        return response()->json([
            'success' => true,
            'message' => 'all experiences',
            'data' => ['experiences' =>$experiences]
        ]);
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
        $request->validate([
            'title' => 'required',
            'company' => 'required',
            'years' => 'required|integer'
        ]);

        $exp = Experience::create([
            'freelance_id' => Auth::user()->freelance->id,
            'title' => $request->title,
            'company' => $request->company,
            'description' => $request->description,
            'years' => $request->years
        ]);

        return response()->json([
            'success' =>true,
            'message' => 'experience added',
            'data'=>$exp
            ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experience $experience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        //
    }
}
