<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = User::where('role', 1)->get();
        return view('backend.admin.seller.index', ['sellers' => $sellers]);
    }

    public function create()
    {
        return view('backend.admin.seller.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'  => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'password', 'confirmed', 'min:8'],
            'telp' => ['required', 'numeric'],
            'alamat' => ['required'],
            'prov' => ['required', 'string'],
            'kab' => ['required', 'string'],
            'kec' => ['required', 'string']
        ]);

        $request->password = Hash::make($request->password);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
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
        return view('backend.admin.seller.edit', ['seller' => $seller ]);
    }

    public function update(Request $request, $id)
    {
        $user =  User::findOrFail($id);
        $request->validate([
            'name'  => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id ],
            'password' => ['confirmed'],
            'telp' => ['required', 'numeric'],
            'alamat' => ['required'],
            'prov' => ['required', 'string'],
            'kab' => ['required', 'string'],
            'kec' => ['required', 'string']
        ]);

        $request->password = Hash::make($request->password);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
            'prov' => $request->prov,
            'kab' => $request->kab,
            'kec' => $request->kec,
        ]);
        return redirect('seller')->with('msg', 'Data Updated');
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return redirect('seller')->with('msg', 'Data Deleted');
    }
}
