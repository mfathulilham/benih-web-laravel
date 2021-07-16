<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Benih,User,Keranjang};
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        $name = Auth::user()->name;
        $alamat = Auth::user()->alamat;
        $kec = Auth::user()->kec;
        $kab = Auth::user()->kab;
        $prov = Auth::user()->prov;

        // $keranjangs = Keranjang::where('user_id', Auth::user()->id)->get();


        return view('frontend.keranjang', compact('name', 'alamat','kec','kab','prov'));
    }
}
