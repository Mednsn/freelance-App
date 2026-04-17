<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMissionRequiste;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MissionControllerApi extends Controller
{

    public function index()
    {
        $missions = Mission::with('client')->latest()->get();

        return response()->json($missions);
    }

    public function show($id)
    {
        $mission = Mission::with('client')->find($id);

        if (!$mission) {
            return response()->json([
                'success' => false,
                'message' => 'Mission not found'
            ], 404);
        }

        return response()->json($mission);
    }

    public function store(StoreMissionRequiste $request)
    {
        $validated = $request->validated();

        $mission = Mission::create([
            'user_id' => auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'budget' => $validated['budget'],
            'duree_by_day' => $validated['duree_by_day'],
            'type' => $validated['type'],
            'category_id' => $validated['category_id'],
            'statut' => 'Ouverte'
        ]);
        $mission->technologies()->sync($request->technologies);

        return response()->json([
            'success' => true,
            'message' => 'Mission created',
            'data' => $mission
        ]);
    }

    public function update(Request $request, $mission)
    {

        if (!$mission) {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'mission not found'
                ],
                404
            );
        }

        if ($mission->client_id !== auth::id()) {
            return response()->json(
                [
                    'message' => 'mot authorized'
                ],
                403
            );
        }

        $mission->update($request->all());

        return response()->json([
            'message' => 'Mission updated',
            'data' => $mission
        ]);
    }

    public function destroy($mission)
    {


        if (!$mission) {
            return response()->json(['message' => 'Mission not found'], 404);
        }

        if ($mission->client_id !== Auth::id()) {
            return response()->json(['message' => 'Not authorized'], 403);
        }

        $mission->delete();

        return response()->json([
            'message' => 'Mission deleted'
        ]);
    }
}
