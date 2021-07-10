<?php

namespace App\Http\Controllers\Backend\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerPengirimanController extends Controller
{
    public function index()
    {
        return view('backend.seller.transaksi.pengiriman.index');
    }
}
