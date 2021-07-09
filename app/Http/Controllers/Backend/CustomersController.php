<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 0)->get();
        return view('backend.customers.index', ['customers' => $customers]);
    }
    public function edit($id)
    {
        $customer = User::findOrFail($id);
        return view('backend.customers.edit', ['customer' => $customer]);
    }
}
