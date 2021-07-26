<?php

namespace App\Http\Controllers\Backend\Seller;

use App\Models\{Benih,User,Keranjang,Transaksi};
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerPemesananController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::where('seller_id', Auth::user()->id)->get();
        return view('backend.seller.transaksi.pemesanan.index', ['transaksis'=> $transaksis]);
    }

}
