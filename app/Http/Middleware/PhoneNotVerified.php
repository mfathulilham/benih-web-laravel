<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PhoneNotVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user) {
            if ( empty($user->telp_verified_at)  ) {
                return redirect('/verify');
            }
            return $next($request);
        } return $next($request);

    }
}
