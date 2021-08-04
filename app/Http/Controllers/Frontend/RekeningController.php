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
            'nama_pemilik'  => ['required', 'string'],
            'nomor_rekening'  => ['required', 'string']
        ]);
        $request['nama_rekening'] =  $request->nama_rekening  . ' a/n ' . $request->nama_pemilik;
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
