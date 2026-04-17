<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClientMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message'=>'Unauthenticated'], 401);
        }

        if ($user->role !== 'client') {
            return response()->json(['message'=>'Access denied, client only'], 403);
        }

        return $next($request); 
    }
}