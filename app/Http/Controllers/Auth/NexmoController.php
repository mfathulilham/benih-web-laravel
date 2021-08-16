<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Nexmo;

class NexmoController extends Controller
{
    public function index() {
        return view('auth.nexmo');
    }

    public function verify(Request $request) {
        //  $this->validate($request, [
        //      'code' => 'size:4'
        //  ]);

        //  $request_id = session('nexmo_request_id');
        //  $verification = new \Nexmo\Verify\Verification($request_id);

        //  Nexmo::verify()->check($verification, $request->code);

        //  $date = date_create();
        //  DB::table('users')->where('id', Auth::id())->update(['telp_verified_at' => date_format($date, 'Y-m-d H:i:s')]);

        //  return redirect('/');
        $this->validate($request, [
            'code' => 'size:4',
        ]);

        try {
            Nexmo::verify()->check(
                $request->session()->get('verify:request_id'),
                $request->code
            );
            Auth::loginUsingId($request->session()->pull('verify:user:id'));
            return redirect('/');
        } catch (Nexmo\Client\Exception\Request $e) {
            return redirect()->back()->withErrors([
                'code' => $e->getMessage()
            ]);

        }
    }
}
