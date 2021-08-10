@extends('backend.seller.transaksi.master')
@section('content-transaksi')

@if (session('msg'))
    <div class="row g-0 mx-4 mt-4">
        <p class="alert alert-success">{{ session('msg') }}</p>

    </div>
@endif

@forelse ($transaksis as $transaksi)
{{-- @if ($transaksi->status == 'Menunggu Pembayaran' || $transaksi->status == 'Menunggu Konfirmasi') --}}

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
                @if ($transaksi->status == 'Menunggu Pembayaran' || $transaksi->status == 'Verifikasi Pembayaran Gagal')
                    <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalDetail{{$transaksi->id}}">Detail</a>
                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalCancel{{$transaksi->id}}">Batalkan</a>
                @elseif ($transaksi->status == 'Menunggu Konfirmasi')
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

                    {{-- <div class="col-4"></div>
                    <div class="col-4 text-success">Biaya Pengiriman</div>
                    <div class="col-4 text-success">
                        <p>Rp. XX.XXX</p>
                    </div>

                    <hr>

                    <div class="col-4"></div>
                    <div class="col-4 fw-bold text-success">Total Keseluruhan</div>
                    <div class="col-4 fw-bold text-success">
                        <p>Rp. X.XXX.XXX</p>
                    </div> --}}

                </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
      </div>

      {{-- MODAL CANCEL --}}
      <div class="modal fade" id="modalCancel{{$transaksi->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('seller_pengiriman-cancel', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                        <p>Yakin Ingin Membatalkan Pemesanan ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Batalkan Pemesanan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    </div>
                </div>
            </form>
        </div>
      </div>

@empty
    <h5 class="text-center mt-5">Belum Ada Data</h5>

</div>

@endforelse

@endsection
