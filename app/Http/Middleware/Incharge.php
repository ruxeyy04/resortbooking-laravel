<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Incharge
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

        if ($usertype == 'in-charge') {
            return $next($request);
        }

        switch ($usertype) {
            case 'customer':
                return redirect('/uindex');
                break;
            case 'admin':
                return redirect('/admin');
                break;
            default:
                break;
        }
    }
}
