<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AccessInstitutions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            
            if (!$user) {
                return response()->json(['error' => 'user_not_found'], 404);
            }

            if ($user->subscription->has_institution != 1 || $user->institution_id != null) {
                return response()->json(['error' => 'no_permission'], 404);
            }

        } catch (JWTException $e) {
            return response()->json(['error' => 'invalid token'], 403);
        }

        return $next($request);
    }
}
