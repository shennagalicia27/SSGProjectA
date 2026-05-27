<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->session()->get('user_account');

        if (! $user || ! in_array($user['role'], $roles, true)) {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to access that page.');
        }

        return $next($request);
    }
}
