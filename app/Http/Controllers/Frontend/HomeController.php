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
        $benih = Benih::findOrFail($id);
        return view('frontend.detail', ['benih' => $benih]);
    }
    public function add(Request $request, $id)
    {
        $data = $request->validate([
            'jumlah' => ['required','numeric','gt:0']
        ]);

        $benih = Benih::findOrFail($id);
        $total_harga = ($benih->harga) * $request->jumlah ;

        $data['user_id'] = Auth::user()->id;
        $data['benih_id'] = $benih->id;
        $data['total_harga'] = $total_harga;

        // dd($data);

        Keranjang::create($data);
        return redirect('keranjang')->with('msg', 'Benih telah dimasukkan ke keranjang');
    }
}
