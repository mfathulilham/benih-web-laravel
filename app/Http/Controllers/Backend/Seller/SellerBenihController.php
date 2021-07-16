<?php

namespace App\Http\Controllers\Backend\Seller;

use App\Http\Controllers\Controller;
use App\Models\Benih;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SellerBenihRequest;

class SellerBenihController extends Controller
{
    public function index()
    {
        $benihs = Benih::where('user_id', Auth::user()->id)->get();
        return view('backend.seller.benih.index', ['benihs' => $benihs]);
    }

    public function create()
    {
        return view('backend.seller.benih.create');
    }
    public function store(SellerBenihRequest $request)
    {
        $data = $request->validated();

        $gambar = $request->file('gambar');
        $data['gambar'] = $gambar->storeAs('gambar_benih', time(). '.' . $gambar->getClientOriginalExtension() );
        $data['user_id'] = $request->user()->id;
        Benih::create($data);

        return redirect('benih')->with('msg', 'Benih telah ditambahkan');
    }

    public function edit($id)
    {
        $benih = Benih::findOrFail($id);
        return view('backend.seller.benih.edit', ['benih' => $benih]);
    }

    public function update(SellerBenihRequest $request, $id)
    {
        $benih = Benih::findOrFail($id);
        $data = $request->validated();

        if ($gambar = $request->file('gambar')) {
            Storage::delete($benih->gambar);
            $data['gambar'] = $gambar->storeAs('gambar_benih', time(). '.' . $gambar->getClientOriginalExtension() );
        }
        else {
            $data['gambar'] = $benih->gambar;
        }
        $benih->update($data);

        return redirect('benih')->with('msg', 'Benih telah diedit');

    }

    public function delete($id)
    {
         $benih = Benih::findOrFail($id);
         Storage::delete($benih->gambar);
         $benih->delete();
        return redirect('benih')->with('msg', 'Benih telah dihapus');
    }

}
