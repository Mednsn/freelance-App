<?php

namespace App\Http\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequiste;
use App\Models\Client;
use App\Models\Freelance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthentificationApi extends Controller
{
    public function register(StoreUserRequiste $resquist)
    {
        $validated = $resquist->validated();
        $password = Hash::make($validated['password']);

        if (User::where('email', $validated['email'])->exists()) {
            return response()->json([
                "success" => false,
                "message" => "email est deja utliser."
            ], 401);
        }

        if ($validated['role'] === "client") {
            $role_id = 1;
        } else {
            $role_id = 2;
        }
        $user = User::create([
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'email' => $validated['email'],
            'password' => $password,
            'statut' => "active",
            'role_id' => $role_id,
        ]);


        if ($validated['role'] === "client") {
            Client::created([
                'entreprise' => $validated['entreprise'],
                'description' => $validated['description'],
                'user_id' => $user->id
            ]);
        } else {
            Freelance::created([
                'tarif' => $validated['tarif'],
                'portfolio' => $validated['portfolio'],
                'disponibilite' => $validated['disponibilite'],
                'user_id' => $user->id
            ]);
        }
        $token = $user->createToken('token_api')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'user est ajouter avec success',
            'data' => ['user' => $user, 'token' => $token]
        ]);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) {

            return response()->json([
                'success' => false,
                'message' => 'Email ou mot de passe incorrect'
            ], 401);
        }
        $user = Auth::user();

        $token = $user->createToken('token_ipa')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login success',
            'data' => ['token' => $token, 'user' => $user]
        ]);
    }

    public function logout(Request $request) 
    {
        $request->user()->tokens()->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'you are logout now '
        ], 200);
    }
}
