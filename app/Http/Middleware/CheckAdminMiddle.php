<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
class CheckAdminMiddle
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
        $checkAuthMerchant = \Session::get('authAdmin');
        if (empty($checkAuthMerchant)) {
            return redirect('admin/login');
        }
        return $next($request);
    }
}
