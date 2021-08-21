<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Nexmo\Laravel\Facade\Nexmo;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'telp' => ['required', 'min:12', 'max:15', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        // Nexmo::message()->send([
        //     'to' => $data['telp'],
        //     'from' => 'sender',
        //     'text' => "Dari BenihKu : \n Kode OTP : {$otp} \n Jangan beritahu siapapun"
        // ]);

        $otp = mt_rand(1111,9999);

        return User::create([
            'name' => $data['name'],
            'telp' => $data['telp'],
            'password' => Hash::make($data['password']),
            'role' => $data['daftar'],
            'otp' => $otp
        ]);

        // $verification = Nexmo::verify()->start([
        //     'number' => $data['telp'],
        //     'brand' => 'Verifikasi Telepon',
        // ]);

        // session(['nexmo_request_id' => $verification->getRequestId()]);

        // return redirect('/nexmo');
    }

    // protected function registered(Request $request, User $user)
    //     {
    //         $user->callToVerify();
    //         return redirect($this->redirectPath());
    //     }
}
