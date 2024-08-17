<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $account_id = $request->cookie('account_id');
        // $token = $request->cookie('bearer_token');
    
        // // 1. Retrieve the user based on the account_id
        // $user = User::where('account_id', $account_id)->first();
    
        // $request->headers->set('Authorization', 'Bearer ' . $token);
        
        // if ($user && Auth::guard('web')->check()) {
        //     // Token is valid, continue with the request
            return $next($request);
        // }
        // abort(401);
    }
}
