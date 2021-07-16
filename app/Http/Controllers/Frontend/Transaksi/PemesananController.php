<?php

namespace App\Http\Controllers\Frontend\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
    {
        return view('frontend.pemesanan');
    }
}
