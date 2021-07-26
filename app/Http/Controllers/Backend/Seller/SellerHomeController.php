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
        $transaksis = Transaksi::where('seller_id', Auth::user()->id)->get();
        return view('backend.seller.home.index', ['transaksis' => $transaksis]);
    }
}
