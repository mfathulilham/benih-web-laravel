@extends('layouts.frontend.transaksi_master')
@section('content')

<!-- NAV Tab -->

<!-- Data Pemesanan -->

{{-- <div class="row mx-3 mt-4 text-success">
    <h3>Pemesanan</h3>
</div> --}}

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
@foreach ($transaksis as $transaksi)
@if ($transaksi->status == 'Menunggu Pengiriman' || $transaksi->status == 'Proses Pengiriman')

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


    <div class="col-8 col-lg-9"></div>
        <div class="statusTransaksi col-4 col-lg-3 fw-bold">
            <p>{{ $transaksi->status}}</p>
        </div>

        <div class="btnTransaksi col-12">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalDetail{{$transaksi->id}}">Detail</a>
            </div>
        </div>

    </div>

    <!-- Modal Pembayaran-->
    <div class="modal fade" id="modalDetail{{$transaksi->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-4">
                                Total Pembayaran
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" id="pembayaran" aria-describedby="nilai" value="Rp. {{ number_format($transaksi->keranjang()->sum('total_harga'), 0, ',', '.') }}" disabled>
                            </div>
                            <div class="col-4">
                                Bayar Ke Rekening
                            </div>
                            <div class="col-8">
                                <select class="form-select" aria-label="Default select example" name="rekening">
                                    <option value="Fathul - BRI - 1234567">Fathul - BRI - 1234567</option>
                                    <option value="Ilham - BNI - 7891011">Ilham - BNI - 7891011</option>
                                </select>
                            </div>
                            <div class="col-4">
                                Bukti Transfer
                            </div>
                            <div class="col-8">
                                <input class="form-control @error('bukti_transfer') is-invalid @enderror" id="bukti_transfer" name="bukti_transfer" type="file" required>
                                @error('bukti_transfer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" onclick="return confirm('Pemesanan tidak dapat dibatalkan setelah ini, Setuju?')" class="btn btn-primary">Bayar Sekarang</button>
                    </div>
                </div>
            </form>
        </div>
      </div>

{{-- @elseif ($transaksi->status != 'Menunggu Pengiriman' || $transaksi->status != 'Proses Pengiriman')
    <p class="text-center">No Data Yet...</p> --}}

@endif

@endforeach


@endsection
