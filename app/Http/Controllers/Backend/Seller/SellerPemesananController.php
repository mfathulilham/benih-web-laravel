<?php

namespace App\Http\Controllers\Backend\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerPemesananController extends Controller
{
    public function index()
    {
        return view('backend.seller.transaksi.pemesanan.index');
    }

}
