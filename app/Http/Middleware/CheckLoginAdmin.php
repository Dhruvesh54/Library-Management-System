<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if(!(session()->has('user') && session()->has('password') && session()->has('role')))
        if(!(session()->has('adminuser') ))
        {
            return redirect()->route('admin.add_book');
        }
        return $next($request);
    }
}
