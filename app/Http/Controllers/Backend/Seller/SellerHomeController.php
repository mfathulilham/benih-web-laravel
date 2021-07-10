<?php

namespace App\Http\Controllers\Backend\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerHomeController extends Controller
{
    public function index()
    {
        return view('backend.seller.home.index');
    }
}
