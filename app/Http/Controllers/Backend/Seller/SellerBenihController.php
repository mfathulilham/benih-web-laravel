<?php

namespace App\Http\Controllers\Backend\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerBenihController extends Controller
{
    public function index()
    {
        return view('backend.seller.benih.index');
    }

    public function create()
    {
        return view('backend.seller.benih.create');
    }
}
