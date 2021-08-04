<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Benih,User,Keranjang,Transaksi,Rekening};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    public function index()
    {
        $benihs = Benih::where('stok','>', 0)->get();
        return view('frontend.home', compact('benihs'));
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $benihs = Benih::query()
            ->where('judul', 'LIKE', "%{$search}%")
            ->where('stok', '>', 0)
            ->get();
        // $benihs = Benih::query()
        //     ->where('judul', 'LIKE', "%{$search}%")
        //     ->orWhere('', 'LIKE', "%{$search}%")
        //     ->get();

        // Return the search view with the resluts compacted
        return view('frontend.search', compact('benihs', 'search'));
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
        // $available = NULL;
        // foreach ($keranjangs as $keranjang) {
        //     if ($keranjang) {
        //         foreach ($keranjang->status as $status) {
        //             if ($status == 'keranjang'){
        //                 $available = 0;
        //             }
        //         }
        //     }
        // }
        // $keranjangs = Keranjang::where('user_id', Auth::user()->id)->get();

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

    public function profile()
    {
        $user = Auth::user();
        return view('frontend.profile', ['user' => $user]);
    }

    public function profile_update(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $data = $request->validate([
            'name'  => ['required', 'string'],
            'password' => ['confirmed'],
            'lahir' => ['required', 'date'],
            'telp' => ['required', 'numeric'],
            'alamat' => ['required'],
            'prov' => ['required', 'string'],
            'kab' => ['required', 'string'],
            'kec' => ['required', 'string']
        ]);

        $data['prov'] = explode(',',$request->prov)[0];
        $data['kab'] = explode(',',$request->kab)[0];
        $data['kec'] = explode(',',$request->kec)[0];

        $user->update($data);
        return redirect('profile')->with('msg', 'Data Telah Diubah');
    }

    public function password()
    {
        return view('frontend.password');
    }

    public function pass_update(Request $request)
    {
        $data = $request->validate([
            'pass_old' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $check = Hash::check($request->pass_old, Auth::user()->password);
        if ($check) {
            if ($request->pass_old == $request->password) {
                return redirect('password')->with('msg', 'Password Baru Tidak Boleh Sama dengan Password Lama');
            }
            else {
                $user = User::findOrFail(Auth::user()->id);
                $data['password'] = Hash::make($request->password);
                $user->update($data);
                return redirect('profile')->with('msg', 'Password Telah diubah');
            }
        }
        else return redirect('password')->with('msg', 'Password lama salah, Coba lagi');
    }
}
