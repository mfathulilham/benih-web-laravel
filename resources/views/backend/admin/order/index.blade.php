@extends('layouts.backend.admin.master')
@section('content')

<!-- CONTENT -->

<div class="col-11 admin col-md-8 col-lg-9">
    {{-- <div class="container">

        <h3>
            <i class="far fa-handshake me-2"></i>
            Order
        </h3>

        <hr>

        <div class="row mt-4">
            <div class="col-4">
                <a href="#" class="container-fluid btn btn-warning text-light text-center">
                  <h4 class="pemesanan-count mt-5">60</h4>
                  <p>Orders</p>
                </a>
              </div>

              <div class="col-4">
                <a href="#" class="container-fluid btn btn-info text-light text-center">
                  <h4 class="pengiriman-count mt-5">7</h4>
                  <p>Today Order</p>
                </a>
              </div>

              <div class="col-4">
                <a href="#" class="container-fluid btn btn-danger text-light text-center">
                  <h4 class="cancel-count mt-5">2</h4>
                  <p>Canceled Order</p>
                </a>
              </div>
        </div>

    </div> --}}
    <div class="container">

        <h3>
            <i class="fas fa-users me-2"></i>
            Pembayaran
        </h3>

        <hr>

        @if (session('msg'))
            <p class="alert alert-success">{{ session('msg') }}</p>
        @endif

        @foreach ($transaksis as $transaksi)
        @if ($transaksi->status == 'Menunggu Pembayaran')

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Transaksi</th>
                    <th>Nama Pengirim</th>
                    <th>Kirim Ke Rekening</th>
                    <th>Bukti Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                @php
                    $angkaAwal = 1
                @endphp
                @foreach ($transaksi->keranjang as $keranjang)

                <tr>
                    <td>{{ $angkaAwal++ }}</td>
                    <td>2021090{{ $keranjang->id}}</td>
                    <td>{{ $keranjang->user->name}}</td>
                    <td>{{ $keranjang->rekening}}</td>
                    <td>
                        <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalBukti{{$transaksi->id}}">Lihat Bukti</a>
                    </td>
                    <td>
                        <form action="{{ route('order-confirm', $keranjang->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- <a href="#" class="btn btn-secondary"><i class="far fa-edit"></i></a> --}}
                                <button class="btn btn-success" onclick="return confirm('Konfirmasi Pembayaran ?')" type="submit">Confirm</button>
                                <button class="btn btn-danger" onclick="return confirm('Tolak Pembayaran ?')" type="submit">Cancel</button>
                        </form>
                    </td>
                </tr>

                @endforeach

                <!-- Modal Bukti Pembayaran-->
                <div class="modal fade" id="modalBukti{{$transaksi->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <img src="{{ $transaksi->img }}" width="465" alt="bukti">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>

            </tbody>
            </table>
        </div>

        @endif
        @endforeach

    </div>
</div>

<!-- CONTENT END -->

@endsection
