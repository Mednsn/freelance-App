<?php

namespace App\Http\Api;

use App\Http\Controllers\Controller;
use App\Models\Freelance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreelanceControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function addSkills(Request $request)
    {
        $freelance = Auth::user()->freelance;

        $freelance->skills()->sync($request->skills);

        return response()->json([
            'message' => 'Skills updated'
        ]);
    }

    public function addTechnologies(Request $request)
    {
        $freelance = auth::user()->freelance;

        $freelance->technologies()->sync($request->technologies);

        return response()->json([
            'success' => true,
            'message' => 'Technologies updated'
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Freelance $freelance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Freelance $freelance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Freelance $freelance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Freelance $freelance)
    {
        //
    }
}
