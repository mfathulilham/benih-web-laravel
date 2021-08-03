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
        $transaksis = Transaksi::where('user_id', Auth::user()->id)->where('status','Menunggu Pembayaran')->orWhere('status','Menunggu Konfirmasi')->orWhere('status','Verifikasi Gagal')->get();
        // $transaksis = Transaksi::where('user_id', Auth::user()->id)->get();
        $seller = NULL;
        $user = NULL;
        foreach ($transaksis as $transaksi) {
            foreach ($transaksi->keranjang as $keranjang) {
                $seller = User::findOrFail($keranjang->benih->user_id);
                $user = User::findOrFail($keranjang->user_id);
            }
        }
        return view('frontend.pemesanan', ['transaksis' => $transaksis, 'seller' => $seller, 'user' => $user]);
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

        return redirect('pemesanan')->with('msg', 'Pembayaran telah ditambahkan');
    }

    public function cancel(Request $request, $id)
    {
        //  Status Berubah menjadi dibatalkan
        $data['status'] = 'Dibatalkan';
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($data);

        // Add stok benih saat dibatalkan
        $keranjangs = $transaksi->keranjang;
        // dd($keranjang->benih_id);
        foreach($keranjangs as $keranjang){
            $benih = Benih::findOrFail($keranjang->benih_id);
            $data['stok'] = $benih->stok + $keranjang->jumlah;
            $benih->update($data);
        }
        return redirect('cancel')->with('msg', 'Pemesanan telah dibatalkan');
    }

    public function user_pengiriman()
    {
        $transaksis = Transaksi::where('user_id', Auth::user()->id)->where('status','Menunggu Pengiriman')->orWhere('status','Proses Pengiriman')->get();
        $seller = NULL;
        $user = NULL;
        foreach ($transaksis as $transaksi) {
            foreach ($transaksi->keranjang as $keranjang) {
                $seller = User::findOrFail($keranjang->benih->user_id);
                $user = User::findOrFail($keranjang->user_id);
            }
        }
        return view('frontend.pengiriman', ['transaksis' => $transaksis, 'seller' => $seller, 'user' => $user]);
    }

    public function user_cancel()
    {
        $transaksis = Transaksi::where('user_id', Auth::user()->id)->where('status','Dibatalkan')->get();
        $seller = NULL;
        $user = NULL;
        foreach ($transaksis as $transaksi) {
            foreach ($transaksi->keranjang as $keranjang) {
                $seller = User::findOrFail($keranjang->benih->user_id);
                $user = User::findOrFail($keranjang->user_id);
            }
        }
        return view('frontend.cancel', ['transaksis' => $transaksis, 'seller' => $seller, 'user' => $user]);
    }

    public function user_selesai()
    {
        $transaksis = Transaksi::where('user_id', Auth::user()->id)->where('status','Pengiriman Selesai')->orWhere('status','Selesai')->get();
        $seller = NULL;
        $user = NULL;
        foreach ($transaksis as $transaksi) {
            foreach ($transaksi->keranjang as $keranjang) {
                $seller = User::findOrFail($keranjang->benih->user_id);
                $user = User::findOrFail($keranjang->user_id);
            }
        }
        return view('frontend.selesai', ['transaksis' => $transaksis, 'seller' => $seller, 'user' => $user]);
    }

    public function user_rating(Request $request, $id)
    {
        $request->validate([
            'rating'  => ['required', 'numeric'],
        ]);
        // TRANSAKSI RATING = FINISH
        $data['rating'] = 'finish';
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($data);

        // dd($transaksi->keranjang->benih_id);
        foreach ($transaksi->keranjang as $keranjang) {
            $keranjang->benih->rating()->create($request->all());
        }

        return redirect('selesai')->with('msg', 'Rating telah ditambahkan');
    }
}
