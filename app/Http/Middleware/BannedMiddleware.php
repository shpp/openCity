<?php

namespace App\Http\Middleware;

use Closure;

class BannedMiddleware
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
        if (auth()->user()->banned) {
            return $request->ajax() ?
                response()->json(['err' => 403, 'message' => 'Can`t do that. You are banned']) :
                response()->view('errors.403', [], 403);
        }
        return $next($request);
    }
}
