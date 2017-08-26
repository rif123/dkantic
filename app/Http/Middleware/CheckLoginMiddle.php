<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
class CheckLoginMiddle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $checkAuthMerchant = \Session::get('authMerchant');
        if (empty($checkAuthMerchant)) {
            return redirect('merchant/login');
        }
        return $next($request);
    }
}
