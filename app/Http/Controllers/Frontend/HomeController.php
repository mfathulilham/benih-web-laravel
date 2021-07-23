<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Models\Benih;
use App\Models\{Benih,User,Keranjang};
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        $benihs = Benih::where('stok','>', 0)->get();
        return view('frontend.home', ['benihs' => $benihs]);
    }

    public function detail($id)
    {
        if (Auth::user()) {
            $benih = Benih::findOrFail($id);
            return view('frontend.detail', ['benih' => $benih]);
        }
        else return view('auth.login');
    }
    public function add(Request $request, $id)
    {
        $data = $request->validate([
            'jumlah' => ['required','numeric','gt:0']
        ]);

        $benih = Benih::findOrFail($id);
        $keranjangs = Keranjang::where('user_id', Auth::user()->id)->get();
        // dd($keranjangs);
        foreach ($keranjangs as $keranjang) {
            if ($keranjang->benih_id == $benih->id) {
                $jumlah = ($keranjang->jumlah) + $request->jumlah;
                $total_harga = $jumlah * $keranjang->total_harga;

                $data['jumlah'] = $jumlah;
                $data['total_harga'] = $total_harga;

                $keranjang->update($data);
                return redirect('keranjang')->with('msg', 'Benih telah dimasukkan ke keranjang');
            }
        }

        $total_harga = ($benih->harga) * $request->jumlah ;

        $data['user_id'] = Auth::user()->id;
        $data['benih_id'] = $benih->id;
        $data['total_harga'] = $total_harga;

        // dd($data);

        Keranjang::create($data);
        return redirect('keranjang')->with('msg', 'Benih telah dimasukkan ke keranjang');
    }
}
