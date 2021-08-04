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

        {{-- @if ($transaksi->status == 'Menunggu Konfirmasi' || $transaksi->status == 'Selesai' || $transaksi->status == 'Pengiriman Selesai') --}}

        <div class="table-responsive">
            <table class="table table-success table-hover table-bordered table-sm">
            <thead>
                <tr class="align-top text-center">
                    <th>No</th>
                    <th>Id</th>
                    <th>Status Transaksi</th>
                    <th>Bayar Ke Rek</th>
                    <th>Nama Pengirim</th>
                    <th>Nilai Transfer</th>
                    <th>Rekening Pengembalian</th>
                    <th>Bukti</th>
                    <th>Ket</th>
                </tr>
            </thead>
            <tbody>

                @php
                    $angkaAwal = 1
                @endphp
                {{-- @foreach ($transaksi->keranjang as $keranjang) --}}

                @forelse ($transaksis as $transaksi)

                <tr>
                    <td>{{ $angkaAwal++ }}</td>
                    <td>2021090{{ $transaksi->id}}</td>
                    <td>{{ $transaksi->status}}</td>
                    <td>{{ $transaksi->rekening}}</td>
                    <td>{{ $transaksi->user->name}}</td>
                    <td>Rp. {{ number_format($transaksi->keranjang()->sum('total_harga'), 0, ',', '.') }}</td>
                    {{-- <td>{{ $sellers->rekenings()->nama_rekening }}</td> --}}
                    <td>BELUM BISA MUNCUL</td>
                    {{-- <td>BELUM BISA{{ $sellers[0] }}</td> --}}
                    <td>
                        <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalBukti{{$transaksi->id}}">Bukti</a>
                    </td>
                    <td>
                        @if ($transaksi->status == 'Menunggu Konfirmasi')
                            <div class="d-flex justify-content-center">
                                <form action="{{ route('order-confirm', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <button class="btn btn-success" onclick="return confirm('Konfirmasi Pembayaran ?')" type="submit">Confirm</button>
                                </form>
                                <form action="{{ route('order-cancel', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <button class="btn btn-danger" onclick="return confirm('Tolak Pembayaran ?')" type="submit">Cancel</button>
                                </form>
                        @elseif ($transaksi->status == 'Pengiriman Selesai')
                            <form action="{{ route('order-selesai', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <button class="btn btn-success" onclick="return confirm('Transfer Ke Penjual Telah Selesai ?')" type="submit">Transfer Penjual</button>
                            </form>
                        @elseif ($transaksi->status == 'Selesai')
                            Transfer Penjual Berhasil
                        @else
                                @if ($transaksi->gambar == NULL)
                                    Dibatalkan
                                @else
                                    <form action="{{ route('order-dana_pembeli', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                            <button class="btn btn-success" onclick="return confirm('Transfer Ke Pembeli Telah Selesai ?')" type="submit">Transfer Pembeli</button>
                                    </form>
                                @endif
                        @endif
                    </td>
                </tr>

                {{-- @endforeach --}}

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

                @empty
                <td colspan="9">
                    <p class="text-center mt-3">Belum Ada Data Pembayaran</p>
                </td>
                @endforelse

            </tbody>
            </table>
        </div>

        {{-- @endif --}}

    </div>
</div>

<!-- CONTENT END -->

@endsection
