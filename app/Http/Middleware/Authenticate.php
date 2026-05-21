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
        $url = $request->url();

        if (str_contains($url, 'admin')) {
            return $request->expectsJson() ? null : route('admin.auth.login');
        } 
        
        return $request->expectsJson() ? null : route('customer.auth.login');
    }
}
