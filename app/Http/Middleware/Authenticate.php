<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // For API requests just return null → Laravel will send 401 JSON
        if ($request->expectsJson() || $request->is('api/*')) {
            return null;
        }

        // For normal web routes (if you ever add them)
        return route('login');
    }
}