<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 0)->get();
        return view('backend.admin.customers.index', ['customers' => $customers]);
    }
    public function edit($id)
    {
        $customer = User::findOrFail($id);
        return view('backend.admin.customers.edit', ['customer' => $customer]);
    }
    public function update(Request $request, $id)
    {
        $user =  User::findOrFail($id);
        $request->validate([
            'name'  => ['required', 'string'],
            'email' => ['email', 'unique:users,email,' . $user->id ],
            'password' => ['confirmed'],
            'lahir' => ['required', 'date'],
            // 'telp' => ['required', 'numeric'],
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
            'lahir' => $request->lahir,
            // 'telp' => $request->telp,
            'alamat' => $request->alamat,
            'prov' => $request->prov,
            'kab' => $request->kab,
            'kec' => $request->kec,
        ]);
        return redirect('customer')->with('msg', 'Data Updated');
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return redirect('customer')->with('msg', 'Data Deleted');
    }
}
