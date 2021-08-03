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
        $transaksis = Transaksi::where('seller_id', Auth::user()->id)->where('status','Menunggu Pembayaran')->orWhere('status','Menunggu Konfirmasi')->get();
        // $transaksis = Transaksi::where('user_id', Auth::user()->id)->get();
        $seller = NULL;
        $user = NULL;
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
        $transaksis = Transaksi::where('seller_id', Auth::user()->id)->where('status','Menunggu Pengiriman')->orWhere('status','Proses Pengiriman')->get();
        $seller = NULL;
        $user = NULL;
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
        $transaksis = Transaksi::where('seller_id', Auth::user()->id)->where('status','Telah Dikirim')->orWhere('status','Pengiriman Selesai')->get();
        $seller = NULL;
        $user = NULL;
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
        $transaksis = Transaksi::where('seller_id', Auth::user()->id)->where('status','Dibatalkan')->get();
        $seller = NULL;
        $user = NULL;
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

            // Add stok benih saat dibatalkan
            $keranjangs = $transaksi->keranjang;
            foreach($keranjangs as $keranjang){
                $benih = Benih::findOrFail($keranjang->benih_id);
                $data['stok'] = $benih->stok + $keranjang->jumlah;
                $benih->update($data);
            }

            return redirect('seller_pemesanan')->with('msg', 'Pemesanan telah dibatalkan');
        }
    }

    public function seller_pengiriman_kirim($id)
    {
        //  Status Berubah menjadi Proses Pengiriman
        if (isset($id)) {
            $data['status'] = 'Proses Pengiriman';
            $transaksi = Transaksi::findOrFail($id);
            $transaksi->update($data);
            return redirect('seller_pengiriman')->with('msg', 'Status Benih Dalam Proses Pengiriman');
        }
    }

    public function seller_pengiriman_selesai($id)
    {
        //  Status Berubah menjadi Pengiriman Selesai
        if (isset($id)) {
            $data['status'] = 'Pengiriman Selesai';
            $transaksi = Transaksi::findOrFail($id);
            $transaksi->update($data);

            $keranjangs = Keranjang::where('transaksi_id', $id)->get();
            foreach ($keranjangs as $keranjang) {
                $benih = Benih::findOrFail($keranjang->benih_id);
                $terjual['terjual'] = $benih->terjual += $keranjang->jumlah;
                $benih->update($terjual);
            }

            return redirect('seller_selesai')->with('msg', 'Pengiriman Selesai');
        }
    }



}
