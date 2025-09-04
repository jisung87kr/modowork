<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user()) {
            return response()->json([
                'message' => '인증이 필요합니다.'
            ], 401);
        }

        if (!$request->user()->hasRole($role)) {
            return response()->json([
                'message' => '이 리소스에 접근할 권한이 없습니다.'
            ], 403);
        }

        return $next($request);
    }
}