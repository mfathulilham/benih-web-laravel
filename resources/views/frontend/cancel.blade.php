@extends('layouts.frontend.transaksi_master')
@section('content')

<!-- NAV Tab -->

<!-- Data Pemesanan -->

{{-- <div class="row mx-3 mt-4 text-success">
    <h3>Pemesanan</h3>
</div> --}}

@include('layouts.frontend._navtabs')


@if (session('msg'))
    <div class="row g-0 mx-4 mt-4">
        <p class="alert alert-success">{{ session('msg') }}</p>

                {{-- <div class="col">
                    <input class="form-control me-2" type="search" placeholder="Cari..." aria-label="Search">
                </div>
                <div class="col-2 col-md-1">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </div> --}}
    </div>
@endif

{{-- MAIN CONTENT --}}
@forelse ($transaksis as $transaksi)
{{-- @if ($transaksi->status == 'Dibatalkan') --}}

<div class="row list-pemesanan mx-4 my-3 px-3 py-3 bg-light">

        <div class="col-7 col-lg-9 text-success">
            <p>Id Order : 2021090{{ $transaksi->id }}</p>
        </div>

        <div class="dateTransaksi col-5 col-lg-3">
            <p>{{ $transaksi->created_at}}</p>
        </div>

        <hr>

    @foreach ($transaksi->keranjang as $keranjang)


        <div class="imgTransaksi col-2 col-lg-1">
        <img src="{{ $keranjang->benih->img}}" style="width: 60px; height: 30px;  border-radius: 5px;" alt="">
        </div>

        <div class="titleTransaksi col-10 col-lg-3 fw-bold">
            <p>{{ $keranjang->benih->judul}}</p>
        </div>

        <div class="col-2"></div>

        <div class="jumlahTransaksi col-1 col-lg-1 fw-light">
            <p>{{ $keranjang->jumlah}}</p>
        </div>

        <div class="col-1 col-lg-1 fw-light">
            <p>x</p>
        </div>

        <div class="hargaTransaksi col-4 col-lg-2 fw-light">
            <p>Rp. {{ number_format($keranjang->benih->harga, 0, ',', '.') }}</p>
        </div>

        <div class="totalTransaksi col-4 col-lg-2 fw-bold text-success">
            <p>Rp. {{ number_format($keranjang->total_harga, 0, ',', '.') }}</p>
        </div>

        <hr>

    @endforeach

    <div class="col-8 col-lg-8">
    </div>
    <div class="col-8 col-lg-2 fw-bold">
        <p>Total Pemesanan</p>
    </div>
    <div class="col-4 col-lg-2 fw-bold text-success">
        <p>Rp. {{ number_format($transaksi->keranjang()->sum('total_harga'), 0, ',', '.') }}</p>
    </div>

    <hr>


    <div class="col-12">
        <div class="d-md-flex justify-content-md-end fw-bold me-3">
            <p>Status : {{ $transaksi->status}}</p>
        </div>
    </div>
    <div class="col-1">
    </div>

        <div class="btnTransaksi col-12">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalDetail{{$transaksi->id}}">Detail</a>
            </div>
        </div>

    </div>

    <!-- Modal Detail-->
    @include('layouts.frontend.detail_modal')

      @empty
      <h5 class="text-center mt-5">Belum Ada Data</h5>
  @endforelse


@endsection
