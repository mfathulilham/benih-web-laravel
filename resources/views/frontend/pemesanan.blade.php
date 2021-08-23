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
{{-- @if ($transaksi->status == 'Menunggu Pembayaran' || $transaksi->status == 'Menunggu Konfirmasi') --}}

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
            @if ($transaksi->gambar != NULL)
                <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalDetail{{$transaksi->id}}">Detail</a>
            @else
                <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalDetail{{$transaksi->id}}">Detail</a>
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalBayar{{$transaksi->id}}">Bayar</a>
                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalCancel{{$transaksi->id}}">Batalkan</a>
            @endif
        </div>
    </div>

    <!-- Modal Detail-->
    @include('layouts.frontend.detail_modal')

      <!-- Modal Pembayaran-->
      <div class="modal fade" id="modalBayar{{$transaksi->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('pemesanan-bayar', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-4">
                                Pengiriman
                            </div>
                            <div class="col-8">
                                <a href="https://api.whatsapp.com/send?phone={{$keranjang->benih->user->telp}}&text=*NEGOSIASI%20PENGIRIMAN%20BENIH*%0A%0APesanan%20Saya%20:%0A1.%20TOTAL%20HARGA%20=%20*Rp.%20{{ number_format($transaksi->keranjang()->sum('total_harga'), 0, ',', '.') }}*%0A%0AUntuk%20pengiriman%20ke%20Alamat%20{{$keranjang->user->alamat}}%20Kecamatan%20{{$keranjang->user->kec}}%20%20{{$keranjang->user->kab}}." target="_blank" class="btn btn-danger" rel="noopener noreferrer">Klik Untuk Negosiasi</a>
                                {{-- <a href="https://api.whatsapp.com/send?phone=6281298069650&text=*NEGOSIASI%20PENGIRIMAN%20BENIH*%0A%0APesanan Saya%20:%0A1.%20Nama%20Benih%20{{$keranjang->benih->judul}}%0A2.%20Kemasan%20{{$keranjang->benih->variasi}}%20kg%20Jumlah%20{{ $keranjang->jumlah}}%20Pcs%0A3.%20*TOTAL%20HARGA%20Benih%20=%20Rp.%20{{ number_format($transaksi->keranjang()->sum('total_harga'), 0, ',', '.') }}*%0A%0ABerapa%20*HARGA*%20untuk%20pengiriman%20ke%20Alamat%20{{$keranjang->user->alamat}}%20Kecamatan%20{{$keranjang->user->kec}}%20Kabupaten%20{{$keranjang->user->kab}}%20?" target="_blank" class="btn btn-danger" rel="noopener noreferrer">Klik Untuk Negosiasi</a> --}}
                            </div>
                            <div class="col-4">
                                Harga Benih
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" id="pembayaran" aria-describedby="nilai" value="Rp. {{ number_format($transaksi->keranjang()->sum('total_harga'), 0, ',', '.') }}" disabled>
                            </div>
                            <div class="col-4">
                                Bayar Ke Rekening
                            </div>
                            <div class="col-8">
                                <select class="form-select" aria-label="Default select example" name="rekening">
                                    {{-- <option value="Fathul - BRI - 1234567">Fathul - BRI - 1234567</option> --}}
                                    <option value="BNI a/n M FATHUL ILHAM 0612295910">BNI a/n M FATHUL ILHAM 0612295910</option>
                                    {{-- <option value="BNI a/n M FATHUL ILHAM 341801032606533">BRI a/n M FATHUL ILHAM 341801032606533</option> --}}
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
                        <button type="submit" onclick="return confirm('Pemesanan tidak dapat dibatalkan setelah ini, Setuju?')" class="btn btn-success">Bayar Sekarang</button>
                    </div>
                </div>
            </form>
        </div>
      </div>

    <!-- Modal Cancel-->
    <div class="modal fade" id="modalCancel{{$transaksi->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pemesanan-cancel', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <p>Yakin Ingin Membatalkan Pemesanan ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Batalkan Pemesanan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

      {{-- @empty --}}

    {{-- <div class="col text-center">
            <p>Belum ada data</p>
        </div>
    </div> --}}

{{--
@endif --}}
@empty
    <h5 class="text-center mt-5">Belum Ada Data</h5>
@endforelse


@endsection
