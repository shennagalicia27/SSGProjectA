<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionAuthenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->session()->get('user_account');

        if (! $user) {
            return redirect()->route('login.form')->withErrors([
                'auth' => 'Please log in to continue.',
            ]);
        }

        if (
            in_array($user['role'], ['student', 'teacher'], true)
            && $user['must_change_password']
            && ! $request->routeIs('password.change.form', 'password.change.update', 'logout')
        ) {
            return redirect()->route('password.change.form')->withErrors([
                'password' => 'You must change your password before continuing.',
            ]);
        }

        return $next($request);
    }
}
