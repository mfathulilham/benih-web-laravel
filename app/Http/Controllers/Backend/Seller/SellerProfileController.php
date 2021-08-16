<?php

namespace App\Http\Controllers\Backend\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Benih,User,Keranjang,Transaksi,Rekening};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SellerProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('backend.seller.akun.profile', ['user' => $user]);
    }
    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $data = $request->validate([
            'name'  => ['required', 'string'],
            'email' => ['email'],
            'password' => ['confirmed'],
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
        return redirect('seller_profile')->with('msg', 'Data Telah Diubah');
    }
    public function pass()
    {
        return view('backend.seller.akun.password');
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
                return redirect('seller_password')->with('error', 'Password Baru Tidak Boleh Sama dengan Password Lama');
            }
            else {
                $user = User::findOrFail(Auth::user()->id);
                $data['password'] = Hash::make($request->password);
                $user->update($data);
                return redirect('seller_password')->with('msg', 'Password Telah diubah');
            }
        }
        else return redirect('seller_password')->with('error', 'Password lama salah, Coba lagi');
    }

    public function rekening()
    {
        $rekenings = Rekening::where('user_id',Auth::user()->id)->get();
        return view('backend.seller.akun.rekening', compact('rekenings'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'nama_rekening'  => ['required', 'string'],
            'nama_pemilik'  => ['required', 'string'],
            'nomor_rekening'  => ['required', 'string']
        ]);
        $request['nama_rekening'] =  $request->nama_rekening  . ' a/n ' . $request->nama_pemilik;
        $user = User::findOrFail(Auth::user()->id);
        $user->rekenings()->create($request->all());

        return redirect('seller_rekening')->with('msg', 'Rekening telah ditambahkan');
    }

    public function delete($id)
    {
        Rekening::findOrFail($id)->delete();
        return redirect('seller_rekening')->with('msg', 'Rekening Telah Dihapus');
    }
}
