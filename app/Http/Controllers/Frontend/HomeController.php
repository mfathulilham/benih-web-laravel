<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Benih;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        $benihs = Benih::where('stok','>', 0)->get();
        return view('frontend.home', ['benihs' => $benihs]);
    }

    public function keranjang()
    {
        $name = Auth::user()->name;
        $alamat = Auth::user()->alamat;
        $kec = Auth::user()->kec;
        $kab = Auth::user()->kab;
        $prov = Auth::user()->prov;

        return view('frontend.keranjang', compact('name', 'alamat','kec','kab','prov'));
    }
}
