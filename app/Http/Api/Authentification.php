<?php

namespace App\Http\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequiste;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class Authentification extends Controller
{
    public function register(StoreUserRequiste $resquist)
    {
        $validated = $resquist->validate();
        $validated['password'] = Hash::make($validated['password']);

        if (User::where('email', $validated['email'])->exists()) {
            return response()->json([
                "success" => false,
                "message" => "email est deja utliser."
            ], 401);
        }
      if($validated['role'] === "client"){

      }



        $user = User::create($validated);
        $token = $user->createToken('token_api')->plainTextToken;
        return response()->json([
            'success' => true,
            'message' => 'user est ajouter avec success',
            'data' => ['user' => $user, 'token' => $token]
        ]);
    }
}
