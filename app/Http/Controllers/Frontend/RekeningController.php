<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Benih,User,Keranjang,Transaksi,Rekening};
use Illuminate\Support\Facades\Auth;

class RekeningController extends Controller
{
    public function index()
    {
        $rekenings = Rekening::where('user_id',Auth::user()->id)->get();
        return view('frontend.rekening', compact('rekenings'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'nama_rekening'  => ['required', 'string'],
            'nomor_rekening'  => ['required', 'string']
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $user->rekenings()->create($request->all());

        return redirect('rekening')->with('msg', 'Rekening telah ditambahkan');
    }

    public function delete($id)
    {
        Rekening::findOrFail($id)->delete();
        return redirect('rekening')->with('msg', 'Rekening Telah Dihapus');
    }
}
