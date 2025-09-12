<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EditorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || (!auth()->user()->isAdmin() && !auth()->user()->isEditor())) {
            abort(403, 'Access denied. Editor or Admin access required.');
        }

        return $next($request);
    }
}