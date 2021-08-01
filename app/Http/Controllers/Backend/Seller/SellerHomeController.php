<?php

namespace App\Http\Controllers\Backend\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Benih,User,Keranjang,Transaksi};
use Illuminate\Support\Facades\Auth;

class SellerHomeController extends Controller
{
    public function index()
    {
        $pemesanan = Transaksi::where('seller_id', Auth::user()->id)->where('status','Menunggu Pembayaran')->OrWhere('status','Menunggu Konfirmasi')->get();
        $pengiriman = Transaksi::where('seller_id', Auth::user()->id)->where('status','Menunggu Pengiriman')->get();
        $batal = Transaksi::where('seller_id', Auth::user()->id)->where('status','Dibatalkan')->get();
        return view('backend.seller.home.index', ['pemesanan' => $pemesanan, 'pengiriman' => $pengiriman, 'batal' => $batal]);
    }
}
