<?php

namespace App\Http\Api;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mission_id' => 'required',
            'client_id' => 'required',
            'evaluation' => 'required|integer|min:1|max:5',
            'commente' => 'required'
        ]);

        $review = Evaluation::create([
            'mission_id' => $request->mission_id,
            'from_user_id' => Auth::id(),
            'to_user_id' => $request->to_user_id,
            'evaluation' => $request->rating,
            'commente' => $request->comment
        ]);

        return response()->json([
            'success' => true,
            'message' => 'augmenter evaluation',
            'data' => $review
        ]);
    }

    public function moyenneAVG($user_id)
    {
        $avg = Evaluation::where('to_user_id', $user_id)->avg('rating');

        return response()->json([
            'success' => true,
            'message' => 'evaluation moyenne returned',
            'average' => $avg
        ]);
    }
}
