<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        Cookie::queue(Cookie::forget('account_id'));
        Cookie::queue(Cookie::forget('user_type'));
        Cookie::queue(Cookie::forget('bearer_token'));
        return $request->expectsJson() ? null : abort(401);
    }
}
