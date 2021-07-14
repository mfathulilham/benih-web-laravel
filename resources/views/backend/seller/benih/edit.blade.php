@extends('layouts.backend.seller.master')
@section('content')

<div class="col-12 ikb-content ikb-transaksi col-md-8 col-lg-9 pb-3">
    <div class="container">
      <main class="pb-2">
        <h3>
            <i class="fas fa-plus-circle"></i>
            Edit Benih
        </h3>
        <hr>
        <form class="row g-3" method="POST" action="/benih/update/{{ $benih->id }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="col-md-12">
                <label for="judul" class="form-label">Judul Benih</label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ $benih->judul }}">
                @error('judul')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-2">
                <img src="{{ $benih->img }}" class="card-img-top img-thumbnail" alt="...">
            </div>
            <div class="col-md-4">
                <label for="gambar" class="form-label">{{ __('Ganti gambar') }}</label>
                <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar">
                @error('gambar')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="kategori" class="form-label">{{ __('Kategori Benih') }}</label>
                <select class="form-select @error('kategori') is-invalid @enderror" aria-label="Default select example" id="kategori" name="kategori">
                    <option {{ $benih->kategori == 'Padi' ? 'selected' : '' }} value="1">Padi</option>
                    <option {{ $benih->kategori == 'Jagung' ? 'selected' : '' }} value="2">Jagung</option>
                    <option {{ $benih->kategori == 'Kedelai' ? 'selected' : '' }} value="3">Kedelai</option>
                    <option {{ $benih->kategori == 'Kacang - kacangan' ? 'selected' : '' }} value="4">Kacang - kacangan</option>
                </select>
                @error('kategori')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="varietas" class="form-label">{{ __('Varietas') }}</label>
                <select class="form-select @error('varietas') is-invalid @enderror" aria-label="Default select example" id="varietas" name="varietas">
                    <option {{ $benih->varietas == 'Cigeulis' ? 'selected' : '' }} value="1">Cigeulis</option>
                    <option {{ $benih->varietas == 'Ciherang' ? 'selected' : '' }} value="2">Ciherang</option>
                </select>
                @error('varietas')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="umur" class="form-label">Umur Tanaman (Hari)</label>
                <input type="number" class="form-control @error('umur') is-invalid @enderror" id="umur" name="umur" value="{{ $benih->umur }}">
                @error('umur')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="potensi" class="form-label">Potensi Hasil (Kg/Ha)</label>
                <input type="number" class="form-control @error('potensi') is-invalid @enderror" id="potensi" name="potensi" value="{{ $benih->potensi }}">
                @error('potensi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="rekomendasi" class="form-label">Rekomendasi Tanam</label>
                <input type="text" class="form-control @error('rekomendasi') is-invalid @enderror" id="rekomendasi" name="rekomendasi" value="{{ $benih->rekomendasi }}">
                @error('rekomendasi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-12">
                <label for="deskripsi" class="form-label">Deskripsi Benih</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" rows="2" name="deskripsi">{{ $benih->deskripsi }}</textarea>
                @error('deskripsi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="variasi" class="form-label">{{ __('Variasi Kemasan (Kg)') }}</label>
                <select class="form-select @error('variasi') is-invalid @enderror" aria-label="Default select example" id="variasi" name="variasi">
                    <option {{ $benih->variasi == '5' ? 'selected' : '' }} value="1">5</option>
                    <option {{ $benih->variasi == '25' ? 'selected' : '' }} value="2">25</option>
                </select>
                @error('variasi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="stok" class="form-label">{{ __('Stok') }}</label>
                <input id="stok" type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{ $benih->stok }}" required>
                @error('stok')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="harga" class="form-label">{{ __('harga') }}</label>
                <input id="harga" type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ $benih->harga }}" required>
                @error('harga')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-4"></div>
            <div class="col-8">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>

        </form>

      </main>
    </div>
</div>
@endsection
