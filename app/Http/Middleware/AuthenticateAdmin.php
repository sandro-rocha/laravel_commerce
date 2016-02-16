<?php
namespace CodeCommerce\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class AuthenticateAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::user() == null || !Auth::user()->is_admin) {
            return redirect()->guest('auth/login');
        }
        return $next($request);
    }
}