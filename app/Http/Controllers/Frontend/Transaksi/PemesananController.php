<?php

namespace App\Http\Controllers\Frontend\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\{Benih,User,Keranjang,Transaksi};
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::where('user_id', Auth::user()->id)->get();
        return view('frontend.pemesanan', ['transaksis' => $transaksis]);
    }
    public function bayar(Request $request, $id)
    {
        $request->validate([
            'rekening'  => ['required', 'string'],
            'bukti_transfer' => ['required', 'max:5120'],
        ]);

        $gambar = $request->file('bukti_transfer');
        $request['gambar'] = $gambar->storeAs('gambar_bayar', time(). '.' . $gambar->getClientOriginalExtension() );
        $request['status'] = 'Menunggu Konfirmasi';

        Transaksi::findOrFail($id)->update($request->all());

        return redirect('transaksi/pemesanan')->with('msg', 'Pembayaran telah ditambahkan');
    }
}
