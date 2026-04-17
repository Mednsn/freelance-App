<?php

namespace App\Http\Api;

use App\Http\Controllers\Controller;
use App\Models\Technologie;
use Illuminate\Http\Request;

class TechnologieControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index() {
        return response()->json(Technologie::all());
    }

    public function store(Request $request) {
        $request->validate(['name'=>'required']);

        return response()->json(
            Technologie::create(['name'=>$request->name])
        );
    }
}