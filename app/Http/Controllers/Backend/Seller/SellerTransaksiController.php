<?php

namespace App\Http\Controllers\Backend\Seller;

use App\Models\{Benih,User,Keranjang,Transaksi};
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerTransaksiController extends Controller
{
    public function pemesanan()
    {
        $transaksis = Transaksi::where('seller_id', Auth::user()->id)->get();
        foreach ($transaksis as $transaksi) {
            foreach ($transaksi->keranjang as $keranjang) {
                $seller = User::findOrFail($keranjang->benih->user_id);
                $user = User::findOrFail($keranjang->user_id);
            }
        }
        return view('backend.seller.transaksi.pemesanan.index', ['transaksis'=> $transaksis, 'seller' => $seller, 'user' => $user]);
    }

    public function pengiriman()
    {
        $transaksis = Transaksi::where('seller_id', Auth::user()->id)->get();
        foreach ($transaksis as $transaksi) {
            foreach ($transaksi->keranjang as $keranjang) {
                $seller = User::findOrFail($keranjang->benih->user_id);
                $user = User::findOrFail($keranjang->user_id);
            }
        }
        return view('backend.seller.transaksi.pengiriman.index', ['transaksis'=> $transaksis, 'seller' => $seller, 'user' => $user]);
    }

    public function selesai()
    {
        $transaksis = Transaksi::where('seller_id', Auth::user()->id)->get();
        foreach ($transaksis as $transaksi) {
            foreach ($transaksi->keranjang as $keranjang) {
                $seller = User::findOrFail($keranjang->benih->user_id);
                $user = User::findOrFail($keranjang->user_id);
            }
        }
        return view('backend.seller.transaksi.selesai.index', ['transaksis'=> $transaksis, 'seller' => $seller, 'user' => $user]);
    }

    public function cancel()
    {
        $transaksis = Transaksi::where('seller_id', Auth::user()->id)->get();
        foreach ($transaksis as $transaksi) {
            foreach ($transaksi->keranjang as $keranjang) {
                $seller = User::findOrFail($keranjang->benih->user_id);
                $user = User::findOrFail($keranjang->user_id);
            }
        }
        return view('backend.seller.transaksi.cancel.index', ['transaksis'=> $transaksis, 'seller' => $seller, 'user' => $user]);
    }

    public function seller_pemesanan_cancel($id)
    {
        //  Status Berubah menjadi dibatalkan
        if (isset($id)) {
            $data['status'] = 'Dibatalkan';
            $transaksi = Transaksi::findOrFail($id);
            $transaksi->update($data);
            return redirect('seller_pemesanan')->with('msg', 'Pemesanan telah dibatalkan');
        }
    }

    public function seller_pengiriman_kirim($id)
    {
        //  Status Berubah menjadi dibatalkan
        if (isset($id)) {
            $data['status'] = 'Proses Pengiriman';
            $transaksi = Transaksi::findOrFail($id);
            $transaksi->update($data);
            return redirect('seller_pengiriman')->with('msg', 'Status Benih Dalam Proses Pengiriman');
        }
    }



}
