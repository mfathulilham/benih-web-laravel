<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        return view('backend.seller.index');
    }

    public function create()
    {
        return view('backend.seller.index');
    }
}
