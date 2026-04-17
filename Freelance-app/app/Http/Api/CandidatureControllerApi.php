<?php

namespace App\Http\Api;

use App\Http\Controllers\Controller;
use App\Models\candidature;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidatureControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $apps = Candidature::where('freelance_id', auth::user()->freelance->id)->get();
        return response()->json([
            'success' =>true,
            'message' => 'all candidatures',
            'data'=>['candidatures'=>$apps]]);
    }

    public function store(Request $request, Mission $mission)
    {
        $request->validate([
            'letter' => 'required',
            'tarif' => 'required|numeric'
        ]);

        $candidature = Candidature::create([
            'mission_id' => $mission->id,
            'freelance_id' => Auth::user()->freelance->id,
            'letter' => $request->letter,
            'tarif' => $request->tarif,
            'statut' => 'en attente'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Applied successfully',
            'data' => $candidature
        ]);
    }

    public function updateStatus(Request $request, $candidature)
    {
        $request->validate([
            'status' => 'required|in:accepted,refused'
        ]);

        if (!$candidature) {
            return response()->json([
                'success' => false,
                'message' => 'Not found'
            ], 404);
        }

        $candidature->update([
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated',
            'data' => $candidature
        ]);
    }


}
