@extends('layouts.frontend.master')

@section('content')

<div class="container mt-5 pt-2">
    <div class="row mt-5">
        <div class="col card px-4 py-4">

            @if (session('msg'))
                <p class="alert alert-success">{{ session('msg') }}</p>
            @endif
            @if (session('error'))
                <p class="alert alert-danger">{{ session('error') }}</p>
            @endif

            <h5 class="mb-3 text-success">Alamat Pengiriman</h5>
            <div class="row g-1">
                <div class="namaPengiriman col-12 col-md-4">
                    <p class="fw-bold">{{ $name }}</p>
                </div>
                <div class="alamatPengiriman col">
                    <p>{{ $alamat }}, Kecamatan {{ $kec }}, {{ $kab }}, Provinsi {{ $prov }}</p>
                </div>
                <div class="col-12 col-md-2">
                    <a href="{{ route('home-profile') }}" class="container-fluid btn btn-success">Ubah</a>
                </div>
            </div>

        </div>
    </div>

    <div class="row mt-3">
        <div class="col card card-keranjang px-4 py-4">

            <h5 class="mb-3 text-success">Keranjang Saya</h5>

            <div class="row mt-2 mx-2 bg-light">

                <div class="col-1">
                    <p class="checkText">Pilih</p>
                </div>

                <div class="col-2">
                  <p>Nama IKB</p>
                </div>

                <div class="col-3">
                  <p>Nama Benih</p>
                </div>

                <div class="col-2">
                  <p>Harga Satuan</p>
                </div>

                <div class="col-1">
                  <p>Jumlah</p>
                </div>

                <div class="col-2">
                  <p>Total Harga</p>
                </div>

                <div class="col-1">
                  <p>Aksi</p>
                </div>
            </div>

            @foreach ($keranjangs as $keranjang)
            <form class="d-none" id="hapus{{$keranjang->id}}" action="{{ route('home-keranjang-delete', $keranjang->id) }}" method="POST">
                @csrf
                @method('DELETE')
            </form>
            @endforeach


            <form action="{{ route('home-keranjang-add') }}" method="POST">
                @csrf

            @forelse ($keranjangs as $keranjang)


                <div class="row mx-2 mt-3 px-2 pt-4 pb-2 bg-light">

                    <div class="col-1">
                        <div class="form-check">
                            <input class="form-check-input checkPilih" type="checkbox" value="{{ $keranjang->id }}" id="keranjang_check" name="keranjang_checks[]">
                        </div>
                    </div>

                    <div class="col-2 titleBenih">
                        <p>{{$keranjang->benih->user->name}}</p>
                    </div>

                    <div class="col-1 imageBenih">
                        <img src="{{ $keranjang->benih->img }}" alt="">
                    </div>

                    <div class="col-2 titleBenih">
                        <p>{{$keranjang->benih->judul}}</p>
                    </div>

                    <div class="col-2 hargaBenih">
                        <p>Rp. {{number_format($keranjang->benih->harga, 0, ',', '.') }}</p>
                    </div>

                    <div class="col-1 jumlahBenih">
                        <p>{{$keranjang->jumlah}}</p>
                    </div>

                    <div class="col-2 totalBenih">
                        <p>Rp. {{number_format($keranjang->total_harga, 0, ',', '.') }}</p>
                    </div>
                    <div class="col-1">
                        <a class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('hapus{{$keranjang->id}}').submit();">Hapus</a>
                        {{-- <form method="POST" action="{{ route('home-keranjang-delete', $keranjang->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Ingin Menghapus Benih yang Dipilih?')" type="submit">Hapus</button>
                        </form> --}}
                    </div>

                </div>

                @empty

                <div class="row mx-2 mt-3 px-2 pt-4 pb-2 bg-light">
                    <div class="col text-center">
                        <p>Belum ada data</p>
                    </div>
                </div>


            @endforelse

            {{-- @forelse ($keranjangs as $keranjang) --}}
            {{-- @if ($available) --}}

            @if (sizeOf($keranjangs) != 0)
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success me-2"></i>Pesan Sekarang</button>
                        </div>
                    </div>
                </div>
            @endif

        </form>

        </div>
    </div>

</div>

@endsection
