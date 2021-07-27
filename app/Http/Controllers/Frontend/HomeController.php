<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Models\Benih;
use App\Models\{Benih,User,Keranjang,Transaksi};
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        $benihs = Benih::where('stok','>', 0)->get();
        // $keranjang_notif = Keranjang::where('user_id',Auth::user()->id);
        return view('frontend.home', compact('benihs'));
    }

    public function keranjang()
    {
        $name = Auth::user()->name;
        $alamat = Auth::user()->alamat;
        $kec = Auth::user()->kec;
        $kab = Auth::user()->kab;
        $prov = Auth::user()->prov;

        $user = Auth::user()->id;
        // $keranjangs = Keranjang::all();
        $keranjangs = Keranjang::where('user_id', Auth::user()->id)->where('status','keranjang')->get();

        return view('frontend.keranjang', compact('name', 'alamat','kec','kab','prov', 'keranjangs'));
    }

    public function keranjang_add(Request $request)
    {
        $transaksi =Transaksi::create([
            'user_id' => Auth::user()->id,
            'status' => 'Menunggu Pembayaran'
        ]);

        foreach ($request->keranjang_checks as $keranjang_check) {
            $keranjang = Keranjang::findOrFail($keranjang_check);
            $keranjang->update([
                "transaksi_id" => $transaksi->id,
                "status" => $transaksi->status,
            ]);
            // Add Seller_id to database transaksi
            $transaksi->seller_id = $keranjang->benih->user_id;
            $transaksi->save();

            // Reduce stok benih saat memesan
            $benih = Benih::findOrFail($keranjang->benih_id);
            $data['stok'] = $benih->stok - $keranjang->jumlah;
            $benih->update($data);
        }
        return redirect('transaksi/pemesanan')->with('msg', 'Benih telah dimasukkan ke keranjang');

        // return view('frontend.pemesanan');
    }

    public function detail($id)
    {
        $benih = Benih::findOrFail($id);
        return view('frontend.detail', ['benih' => $benih]);
    }

    public function profile()
    {
        $user = Auth::user();
        return view('frontend.profile', ['user' => $user]);
    }

    public function add(Request $request, $id)
    {
        $data = $request->validate([
            'jumlah' => ['required','numeric','gt:0']
        ]);

        $benih = Benih::findOrFail($id);
        foreach ($benih->keranjangs as $keranjang) {
            if ($keranjang->transaksi_id == NULL) {
                $jumlah = ($keranjang->jumlah) + $request->jumlah;
                $total_harga = $jumlah * $benih->harga;

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
