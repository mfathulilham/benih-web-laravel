<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Benih,User,Keranjang,Transaksi};
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::where('status', "Menunggu Konfirmasi")->get();
        return view('backend.admin.order.index', ['transaksis' => $transaksis]);
    }

    public function confirm($id)
    {
        $data['status'] = 'Menunggu Pengiriman';

        $transaksi = Transaksi::findOrFail($id)->update($data);
        return redirect('order')->with('msg', 'Pembayaran telah dikonfirmasi');
    }
}
