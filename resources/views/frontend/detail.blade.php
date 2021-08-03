@extends('layouts.frontend.master')

@section('content')

<div class="container mt-5 pt-4">
    <div class="row pt-5 pb-4">
        <div class="col-12 col-md-3">
            <img src="{{ $benih->img }}" class="img-thumbnail" alt="...">
        </div>
        <div class="col-12 col-md-6">
            <h5>{{ $benih->judul }}</h5>
            <p>Terjual {{ $benih->terjual }} | Stok {{ $benih->stok }} | <i class="fas fa-star text-warning"></i>{{($benih->rating()->avg('rating') == NULL) ? '0' : $benih->rating()->avg('rating')}}</p>
            <h2 class="text-success">Rp. {{ number_format($benih->harga, 0, ',', '.') }}</h2>
            <hr>
            <h5 class="text-success"><i class="fas fa-map-marker-alt me-2"></i>{{ $benih->user->name }}</h5>
            <hr>
            <p>Kategori : {{ $benih->kategori }}</p>
            <p>Varietas : {{ $benih->varietas }}</p>
            <p>Umur Tanaman : {{ $benih->umur }} Hari</p>
            <p>Potensi Hasil : {{ $benih->potensi }} kg/Ha</p>
            <p>Kemasan : {{ $benih->variasi }} Kg</p>
            <p>Deskripsi : {{ $benih->deskripsi }}</p>
            <hr>
        </div>
        <div class="col-12 col-md-3">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="/add/{{ $benih->id }}" novalidate>
                        @csrf
                        <h5 class="card-title">Masukkan Jumlah</h5>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" placeholder="Jumlah" required>
                        @error('jumlah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            <button type="submit" class="container-fluid btn btn-success text-center mt-3"><i class="fas fa-shopping-cart me-2"></i>Tambah ke keranjang</button>
                    </form>
                </div>
              </div>
        </div>
    </div>
</div>

@endsection
