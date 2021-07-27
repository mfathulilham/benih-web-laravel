@extends('backend.seller.transaksi.master')
@section('content-transaksi')

@foreach ($transaksis as $transaksi)
<div class="row list-pemesanan mx-4 my-4 px-3 py-3 bg-light">

            <div class="col-8 col-lg-9">
                <p>Id Order : 2021090{{ $transaksi->id }}</p>
            </div>

            <div class="dateTransaksi col-4 col-lg-3">
                <p>{{ $transaksi->created_at}}</p>
            </div>

            <hr>

            @foreach ($transaksi->keranjang as $keranjang)

            <div class="imgTransaksi col-2 col-lg-1">
                <img src="{{ $keranjang->benih->img}}" style="width: 60px; height:30px; border-radius: 5px;" alt="">
            </div>

            <div class="titleTransaksi col-10 col-lg-3 fw-bold">
                <p>{{ $keranjang->benih->judul }}</p>
            </div>

            <div class="col-2"></div>

            <div class="jumlahTransaksi col-1 col-lg-1 fw-light">
                <p>{{ $keranjang->jumlah }}</p>
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

        <div class="col-8 col-lg-9"></div>

        <div class="statusTransaksi col-4 col-lg-3 fw-bold">
            <p>{{ $transaksi->status }}</p>
        </div>


        <div class="btnTransaksi col-12">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="#" class="btn btn-secondary">Detail</a>
                    <a href="#" class="btn btn-danger">Batalkan</a>
            </div>
        </div>

</div>

@endforeach

@endsection
