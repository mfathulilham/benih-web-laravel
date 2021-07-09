<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = User::where('role', 1)->get();
        return view('backend.seller.index', ['sellers' => $sellers]);
    }

    public function create()
    {
        return view('backend.seller.create');
    }
    public function store(Request $request)
    {

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'lahir' => $request->lahir,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
            'prov' => $request->prov,
            'kab' => $request->kab,
            'kec' => $request->kec,
            'role' => $request->role
        ]);

        return redirect('seller')->with('msg', 'Data Added');
    }

    public function edit($id)
    {
        $seller = User::findOrFail($id);
        return view('backend.seller.edit', ['seller' => $seller ]);
    }
}
