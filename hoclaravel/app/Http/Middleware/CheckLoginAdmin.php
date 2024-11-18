<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginAdmin
{

    public function __construct()
    {
        echo "Middleware request <br>";
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!$this->isLogin()) {
            return redirect(route("home"));
        }
        return $next($request);
    }

    public function isLogin() {
        return false;
    }
}
