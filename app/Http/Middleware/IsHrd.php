<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsHrd
{
    public function handle(Request $request, Closure $next): Response
    {

        $isAdminOrHrd = $request->user() && ($request->user()->role_name === 'admin' || $request->user()->role_name === 'hrd');
        if (!$isAdminOrHrd) {
            abort(403, 'Unauthorized. HRD only.');
        }

        return $next($request);
    }
}
