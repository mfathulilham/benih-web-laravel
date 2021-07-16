<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SellerRequest;

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
    public function store(SellerRequest $request)
    {
        $data = $request->validated();
        $data['role'] = 1;

        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect('seller')->with('msg', 'Data Added');
    }

    public function edit(User $user)
    {
        $seller = $user;
        return view('backend.admin.seller.edit', ['seller' => $seller ]);
    }

    public function update(Request $request, $user)
    {
        $user = User::findOrFail($user);
        $data = $request->validate([
            'name'  => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id ],
            'password' => ['confirmed'],
            'telp' => ['required', 'numeric'],
            'alamat' => ['required'],
            'prov' => ['required', 'string'],
            'kab' => ['required', 'string'],
            'kec' => ['required', 'string']
        ]);

        $data['password'] = Hash::make($request->password);

        $user->update($data);
        return redirect('seller')->with('msg', 'Data Updated');
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return redirect('seller')->with('msg', 'Data Deleted');
    }
}
