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
    </div>
@endif

{{-- MAIN CONTENT --}}
@forelse ($transaksis as $transaksi)
{{-- @if ($transaksi->status == 'Telah Dikirim' || $transaksi->status == 'Selesai') --}}

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
            @if ($transaksi->rating == NULL)
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRating{{$transaksi->id}}">Beri Rating</a>
                <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalDetail{{$transaksi->id}}">Detail</a>
            @else
                <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalDetail{{$transaksi->id}}">Detail</a>
            @endif
        </div>
    </div>

    <!-- Modal Detail-->
    @include('layouts.frontend.detail_modal')

      <!-- Modal Rating-->
    <div class="modal fade" id="modalRating{{$transaksi->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Beri Rating</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('selesai-rating', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    </div>
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="rating" id="rating" value="5" checked>
                            <label class="form-check-label ms-2" for="radio">
                                <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="rating" id="rating" value="4">
                            <label class="form-check-label ms-2" for="radio">
                                <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="rating" id="rating" value="3">
                            <label class="form-check-label ms-2" for="radio">
                                <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="rating" id="rating" value="2">
                            <label class="form-check-label ms-2" for="radio">
                                <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col form-check">
                            <input class="form-check-input" type="radio" name="rating" id="rating" value="1">
                            <label class="form-check-label ms-2" for="radio">
                                <i class="fas fa-star text-warning"></i>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    </div>
            </form>
          </div>
        </div>
    </div>
@empty
    <h5 class="text-center mt-5">Belum Ada Data</h5>

</div>
@endforelse


@endsection
