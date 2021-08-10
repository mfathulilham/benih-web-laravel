<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Benih,User,Keranjang,Transaksi, Rekening};
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // $transaksis = Transaksi::all();

        // MENAMBAH REKENING SELLER
        // $selesais = Transaksi::where('status', 'Pengiriman Selesai')->get();
        // $rekenings = array();
        // foreach ($selesais as $selesai => $value) {
        //     dd($selesai);
        // }
        // dd($rekenings = $pengiriman_selesai[0]->seller_id);
        $transaksis = Transaksi::where('seller_id', Auth::user()->id)->where('status','Menunggu Pembayaran')->orWhere('status','Menunggu Konfirmasi')->orWhere('status','Pengiriman Selesai')->orWhere('status','Dibatalkan')->orWhere('status','Selesai')->get();
        // $sellers = array();
        // foreach ($transaksis as $transaksi) {
        //     $seller = User::where('id', $transaksi->seller_id)->get();
        //     array_push($sellers, $seller);
            // array_push($sellers, $seller);
            // dd($sellers[0]->rekenings()->id);
        // }

        return view('backend.admin.order.index', compact('transaksis'));

    }

    public function confirm($id)
    {
        $data['status'] = 'Menunggu Pengiriman';

        $transaksi = Transaksi::findOrFail($id)->update($data);
        return redirect('order')->with('msg', 'Pembayaran telah dikonfirmasi');
    }

    public function cancel($id)
    {
        $data['gambar'] = NULL;
        $data['status'] = 'Pembayaran Gagal';

        $transaksi = Transaksi::findOrFail($id)->update($data);
        return redirect('order')->with('msg', 'Pembayaran telah dikonfirmasi');
    }

    public function selesai($id)
    {
        $data['status'] = 'Selesai';

        $transaksi = Transaksi::findOrFail($id)->update($data);
        return redirect('order')->with('msg', 'Pengembalian Dana Ke Penjual Berhasil');
    }

    public function dana_pembeli($id)
    {
        $data['gambar'] = NULL;

        $transaksi = Transaksi::findOrFail($id)->update($data);
        return redirect('order')->with('msg', 'Pengembalian Dana Ke Pembeli Berhasil');
    }
}
