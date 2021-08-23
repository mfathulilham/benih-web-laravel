<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Nexmo\Laravel\Facade\Nexmo;

class NexmoController extends Controller
{
    public function index() {
        return view('auth.nexmo');
    }

    public function otp() {
        $user = User::findOrFail(Auth::user()->id);

        $otp = mt_rand(1111,9999);

        Nexmo::message()->send([
            'to' => Auth::user()->telp,
            'from' => 'sender',
            'text' => "Dari BenihKu : \n Kode OTP : {$otp} \n Jangan beritahu siapapun"
        ]);

        DB::table('users')->where('id', $user->id)->update(['otp' => $otp]);
        // session()->flash('msg', 'Kode OTP telah dikirim silahkan cek pesan anda !');
        return redirect()->back()->with('msg', 'Kode OTP telah dikirim silahkan cek pesan anda !');
    }

    public function verify(Request $request) {

        $user = User::findOrFail(Auth::user()->id);
        $request->validate([
            'code' => ['required', 'size:4'],
        ]);

        if ($request->code == $user->otp) {
            $date = date_create();
            DB::table('users')->where('id', $user->id)->update(['telp_verified_at' => date_format($date, 'Y-m-d H:i:s')]);
            if ($user->role == 1) {
                Auth::logout();
                return redirect('/login')->with('msg', 'Silahkan tunggu proses Verifikasi oleh Admin, atau email ke benihku@gmail.com');
            } else {
                return redirect('/');
            }
            // $data['telp_verified_at'] = date_format($date, 'Y-m-d H:i:s');
            // $user->update($data);

        } else {
            return redirect('/verify')->with('err', 'Kode OTP salah, Coba Lagi');
        }

        //  $this->validate($request, [
        //      'code' => 'size:4'
        //  ]);

        //  $request_id = session('nexmo_request_id');
        //  $verification = new \Nexmo\Verify\Verification($request_id);

        //  Nexmo::verify()->check($verification, $request->code);

        //  $date = date_create();
        //  DB::table('users')->where('id', Auth::id())->update(['telp_verified_at' => date_format($date, 'Y-m-d H:i:s')]);

        //  return redirect('/');
        // $this->validate($request, [
        //     'code' => 'size:4',
        // ]);

        // try {
        //     Nexmo::verify()->check(
        //         $request->session()->get('verify:request_id'),
        //         $request->code
        //     );
        //     Auth::loginUsingId($request->session()->pull('verify:user:id'));
        //     return redirect('/');
        // } catch (Nexmo\Client\Exception\Request $e) {
        //     return redirect()->back()->withErrors([
        //         'code' => $e->getMessage()
        //     ]);

        // }
    }
}
