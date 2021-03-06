<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsurePhoneIsVerified
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
            if ( !empty($user->telp_verified_at)  ) {
                if ($user->role == 0) {
                    return redirect('/');
                } else return redirect('home');
            }
            return $next($request);
        } else abort('404');


        // if ($user->telp_verified_at == NULL ) {
        //     return redirect('/login');
        // } else
        // return $next($request);
    }
}
