<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Nexmo;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    public function redirectTo() {
        $role = Auth::user()->role;
        switch ($role) {
          case '0':
            if (Auth::user()->telp_verified_at == NULL){
                session()->flash('msg', 'Verifikasi Akun Terlebih Dahulu');
                return '/verify';
            }
            else return '/';
            break;
          case '1':
            if (Auth::user()->telp_verified_at == NULL){
                session()->flash('msg', 'Verifikasi Akun Terlebih Dahulu');
                return '/verify';
            }
            elseif (Auth::user()->confirmed == NULL) {
                Auth::logout();
                session()->flash('msg', 'Menunggu Verifikasi oleh Admin, Silahkan tunggu atau email ke benihku@gmail.com');
                return '/login';
                // return '/login'->with('msg', 'Menunggu Verifikasi oleh Admin, Silahkan tunggu atau email ke benihku@gmail.com');
            } else return '/home';
            break;
          case '2':
            return '/dashboard';
            break;
          default:
            return 'login';
          break;
        }
      }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function username()
    {
        return 'telp';
    }

    // public function authenticated(Request $request, Authenticatable $user)
    // {
        // Auth::logout();
        // $request->session()->put('verify:user:id', $user->id);
        // // @TODO: Send the Verify SMS here
        // $verification = Nexmo::verify()->start([
        //     'number' => $user->telp,
        //     'brand'  => 'Laravel Demo'
        // ]);
        // $request->session()->put('verify:request_id', $verification->getRequestId());

        // return redirect('verify');
    // }

}
