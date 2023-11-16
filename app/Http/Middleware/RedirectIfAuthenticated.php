<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    // Function to check internet connection
    private function checkInternetConnection()
    {
        $url = 'http://www.google.com';
        $timeout = 5;

        $check = @file_get_contents($url, NULL, stream_context_create(['http' => ['timeout' => $timeout]]));

        return ($check !== false);
    }

    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // Check internet connection
        // if (!$this->checkInternetConnection()) {
        //     // No internet connection, handle the error as needed (e.g., redirect or display an error page)
        //     return response("Error: No internet connection. Please check your internet connection and try again.", 500);
        // }

        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
