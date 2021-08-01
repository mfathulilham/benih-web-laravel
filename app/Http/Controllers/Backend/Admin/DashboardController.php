<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Benih,User,Keranjang,Transaksi};
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $transaksis = Transaksi::all();
        $selesai = Transaksi::where('status', 'Selesai')->get();
        $user = User::where('role','0');
        $benih = Benih::where('stok', '>' ,'0');
        return view('backend.admin.dashboard.index', ['selesai' => $selesai, 'user' => $user, 'benih' => $benih]);
    }
}
