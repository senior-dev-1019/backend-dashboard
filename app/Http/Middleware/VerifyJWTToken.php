<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;

class VerifyJwtToken
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

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'user_not_found'], 404);
            }

        } catch (JWTException $e) {
            return response()->json(['error' => 'invalid token'], 403);
        } catch (TokenExpiredException $e) {

            return response()->json(['error' => 'token_expired'], 403);

        } catch (JWTException $e) {

            return response()->json(['error' => 'token_absent'], 403);

        }

        return $next($request);
    }
}
