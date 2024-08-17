<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
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

        $request->headers->set('Authorization', 'Bearer sdfgdf34434g');

        if ($usertype == 'admin') {
            return $next($request);
        }

        switch ($usertype) {
            case 'customer':
                return redirect('/uindex');
                break;
            case 'in-charge':
                return redirect('/in-charge');
                break;
            default:
                break;
        }
    }
}
