<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Benih,User,Keranjang, Transaksi};
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function keranjang()
    {
        $name = Auth::user()->name;
        $alamat = Auth::user()->alamat;
        $kec = Auth::user()->kec;
        $kab = Auth::user()->kab;
        $prov = Auth::user()->prov;

        $user = Auth::user()->id;
        $keranjangs = Keranjang::where('user_id', Auth::user()->id)->where('status','keranjang')->get();

        return view('frontend.keranjang', compact('name', 'alamat','kec','kab','prov', 'keranjangs'));
    }

    public function keranjang_add(Request $request)
    {
        if (isset($request->keranjang_checks)) {
            $user_id = Keranjang::findOrFail($request->keranjang_checks[0])->benih->user->id;
            foreach ($request->keranjang_checks as $keranjang_check) {
                $keranjang = Keranjang::findOrFail($keranjang_check);
                if($keranjang->benih->user->id == $user_id) $user_id = $keranjang->benih->user->id;
                else return back()->with('error', 'Hanya Bisa pilih IKB Yang Sama Bersamaan!');
            }

            $transaksi =Transaksi::create([
                'user_id' => Auth::user()->id,
                'status' => 'Menunggu Pembayaran'
            ]);
            //
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
        }
        else {
            return back()->with('error', 'Pilih keranjang terlebih dahulu');
        }
        return redirect('pemesanan')->with('msg', 'Benih telah dimasukkan ke Daftar Pemesanan');

        // return view('frontend.pemesanan');
    }

    public function delete($id)
    {

        Keranjang::findOrFail($id)->delete();
        return redirect('keranjang')->with('msg', 'Data Keranjang Telah Dihapus');
    }

}
