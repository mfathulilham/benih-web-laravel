@extends('backend.seller.transaksi.master')
@section('content-transaksi')

@if (session('msg'))
    <div class="row g-0 mx-4 mt-4">
        <p class="alert alert-success">{{ session('msg') }}</p>

    </div>
@endif

@foreach ($transaksis as $transaksi)
@if ($transaksi->status == 'Menunggu Pengiriman' || $transaksi->status == 'Proses Pengiriman')

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

        <div class="col-12">
            <div class="d-md-flex justify-content-md-end fw-bold me-3">
                <p>Status : {{ $transaksi->status}}</p>
            </div>
        </div>
        <div class="col-1">
        </div>


        <div class="btnTransaksi col-12">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                @if ($transaksi->status == 'Menunggu Pengiriman')
                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalKirim{{$transaksi->id}}">Kirim</a>
                    <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalDetail{{$transaksi->id}}">Detail</a>
                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalCancel{{$transaksi->id}}">Batalkan</a>
                @elseif ($transaksi->status == 'Proses Pengiriman')
                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalSudahkirim{{$transaksi->id}}">Sudah Dikirim</a>
                    <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalDetail{{$transaksi->id}}">Detail</a>
                @else
                    <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalDetail{{$transaksi->id}}">Detail</a>
                @endif
            </div>
        </div>

        <!-- Modal Detail-->
    <div class="modal fade" id="modalDetail{{$transaksi->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @foreach ($transaksi->keranjang as $keranjang)
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 fw-bold text-success">
                        <p>Benih</p>
                    </div>
                    <div class="col-2">
                        <img src="{{ $keranjang->benih->img}}" style="width: 60px; height: 30px;  border-radius: 5px;" alt="">
                    </div>
                    <div class="col-10 fw-bold">
                        <p>{{ $keranjang->benih->judul}}</p>
                    </div>

                    <div class="col-2"></div>

                    <div class="col-1 fw-light">
                        <p>{{ $keranjang->jumlah}}</p>
                    </div>

                    <div class="col-1 fw-light">
                        <p>x</p>
                    </div>

                    <div class="col-4 fw-light">
                        <p>Rp. {{ number_format($keranjang->benih->harga, 0, ',', '.') }}</p>
                    </div>

                    <div class="col-4 text-success">
                        <p>Rp. {{ number_format($keranjang->total_harga, 0, ',', '.') }}</p>
                    </div>
                    <hr>
                </div>
                @endforeach
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-2 text-success">Total</div>
                    <div class="col-4 fw-bold text-success">
                        <p>Rp. {{ number_format($transaksi->keranjang()->sum('total_harga'), 0, ',', '.') }}</p>
                    </div>

                    <hr>

                    <div class="col-12 fw-bold text-success">
                        <p>Pengiriman</p>
                    </div>
                    <div class="col-2">
                        <p>Dari :</p>
                    </div>
                    <div class="col-10">
                        <p>{{ $seller->name }}, {{ $seller->alamat }} Kec. {{ $seller->kec }}, Kab. {{ $seller->kab }}</p>
                    </div>
                    <div class="col-2">
                        <p>Ke :</p>
                    </div>
                    <div class="col-10">
                        <p>{{ $user->name }}, {{ $user->alamat }} Kec. {{ $user->kec }}, Kab. {{ $user->kab }}</p>
                    </div>

                </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
      </div>

      {{-- MODAL Kirim --}}
      <div class="modal fade" id="modalKirim{{$transaksi->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pengiriman</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('seller_pengiriman-kirim', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                        <p>Kirim  Sekarang ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    </div>
                </div>
            </form>
        </div>
      </div>

      {{-- MODAL SUDAH KIRIM --}}
      <div class="modal fade" id="modalSudahkirim{{$transaksi->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pengiriman</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('seller_pengiriman-selesai', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                        <p>Pemesanan Sudah diKirim ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Selesai</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    </div>
                </div>
            </form>
        </div>
      </div>

</div>
@endif
@endforeach

@endsection
