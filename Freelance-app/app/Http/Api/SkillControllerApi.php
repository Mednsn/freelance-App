<?php

namespace App\Http\Api;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillControllerApi extends Controller
{
  

    public function index() {
        return response()->json(Skill::all());
    }

    public function store(Request $request) {
        $request->validate(['name'=>'required']);

        return response()->json(
            Skill::create(['name'=>$request->name])
        );
    }

}
