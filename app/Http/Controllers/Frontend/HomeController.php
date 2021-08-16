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

    public function detail($id)
    {
        $benih = Benih::findOrFail($id);
        return view('frontend.detail', ['benih' => $benih]);
    }

    public function add(Request $request, $id)
    {
        $rekening = Rekening::where('user_id', Auth::user()->id)->get();
        if (Auth::user()->lahir == NULL) {
            return redirect('profile')->with('err', 'Lengkapi Profil terlebih dahulu');
        }
        elseif (count($rekening) == 0) {
            return redirect('rekening')->with('err', 'Tambahkan Rekening terlebih dahulu');
        } else {
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

            Keranjang::create($data);
            return redirect('keranjang')->with('msg', 'Benih telah dimasukkan ke keranjang');
        }
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
            'email'  => ['email'],
            'password' => ['confirmed'],
            'lahir' => ['required', 'date'],
            // 'telp' => ['required', 'numeric'],
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
