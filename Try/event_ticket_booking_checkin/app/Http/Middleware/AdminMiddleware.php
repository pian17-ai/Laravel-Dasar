<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $user = $request->user();

        if (!in_array($user->role, ['admin','super_admin'])) { // check = super_admin = fail
            return response()->json([
                'message' => 'access forbidden'
            ], 403);
        }

        return $next($request);
    }
}
