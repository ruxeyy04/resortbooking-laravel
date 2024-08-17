<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $usertype = request()->cookie('user_type');
        $account_id = request()->cookie('account_id');


        if (!$usertype) {
            return $next($request);
        }

        switch ($usertype) {
            case 'customer':
                return redirect('/uindex');
                break;
            case 'in-charge':
                return redirect('/in-charge');
                break;
            case 'admin':
                return redirect('/admin');
                break;
            default:
                break;
        }
    }
}
