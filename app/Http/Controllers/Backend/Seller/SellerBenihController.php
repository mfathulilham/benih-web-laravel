<?php

namespace App\Http\Controllers\Backend\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Benih;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    public function store(Request $request)
    {
        $request->validate([
            'judul'  => ['required', 'string'],
            'gambar' => ['required', 'max:5120'],
            'kategori' => ['required', 'string'],
            'varietas' => ['required', 'string'],
            'umur' => ['required', 'numeric'],
            'potensi' => ['required', 'string'],
            'rekomendasi' => ['required', 'string'],
            'deskripsi' => ['required', 'string'],
            'variasi' => ['required', 'string'],
            'stok' => ['required', 'numeric'],
            'harga' => ['required', 'numeric']
        ]);

        $gambar = $request->file('gambar');
        $gambar = $gambar->storeAs('gambar_benih', time(). '.' . $gambar->getClientOriginalExtension() );
        Benih::create([
            'judul' => $request->judul,
            'gambar' => $gambar,
            'kategori' => $request->kategori,
            'varietas' => $request->varietas,
            'umur' => $request->umur,
            'potensi' => $request->potensi,
            'rekomendasi' => $request->rekomendasi,
            'deskripsi' => $request->deskripsi,
            'variasi' => $request->variasi,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'user_id' => Auth::user()->id,
        ]);

        return redirect('benih')->with('msg', 'Benih telah ditambahkan');
    }

    public function edit($id)
    {
        $benih = Benih::findOrFail($id);
        return view('backend.seller.benih.edit', ['benih' => $benih]);
    }

    public function update(Request $request, $id)
    {
        $benih = Benih::findOrFail($id);
        $request->validate([
            'judul'  => ['required', 'string'],
            'gambar' => ['max:5120'],
            'kategori' => ['required', 'string'],
            'varietas' => ['required', 'string'],
            'umur' => ['required', 'numeric'],
            'potensi' => ['required', 'string'],
            'rekomendasi' => ['required', 'string'],
            'deskripsi' => ['required', 'string'],
            'variasi' => ['required', 'string'],
            'stok' => ['required', 'numeric'],
            'harga' => ['required', 'numeric']
        ]);

        if ($gambar = $request->file('gambar')) {
            Storage::delete($benih->gambar);
            $gambar = $gambar->storeAs('gambar_benih', time(). '.' . $gambar->getClientOriginalExtension() );
        }
        else {
            $gambar = $benih->gambar;
        }
        $benih->update([
            'judul' => $request->judul,
            'gambar' => $gambar,
            'kategori' => $request->kategori,
            'varietas' => $request->varietas,
            'umur' => $request->umur,
            'potensi' => $request->potensi,
            'rekomendasi' => $request->rekomendasi,
            'deskripsi' => $request->deskripsi,
            'variasi' => $request->variasi,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'user_id' => Auth::user()->id,
        ]);

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
