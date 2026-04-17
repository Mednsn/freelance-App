<?php

namespace App\Http\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryControllerApi extends Controller
{

    public function index() {
        
        return response()->json(Category::all());
    }

    public function store(Request $request) {
        $request->validate(['name'=>'required']);

        $cat = Category::create([
            'name'=>$request->name
        ]);

        return response()->json($cat);
    }

}
