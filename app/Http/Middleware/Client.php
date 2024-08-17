<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class Client
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
        if ($account_id === null || $usertype === null) {
            return redirect('/login');
        }

        if ($usertype == 'customer') {
            return $next($request);
        }

        switch ($usertype) {
            case 'admin':
                return redirect('/admin');
                break;
            case 'in-charge':
                return redirect('/in-charge');
                break;
            default:
                Cookie::queue(Cookie::forget('account_id'));
                Cookie::queue(Cookie::forget('user_type'));
                return redirect('/');
                break;
        }
    }
}
