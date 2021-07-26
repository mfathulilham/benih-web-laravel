@extends('layouts.backend.seller.master')
@section('content')

<div class="col-12 ikb-content col-md-8 col-lg-9 pb-3">
    <div class="container">
        <h3 class="mb-3 text-success mt-3">Perlu Penanganan</h3>
        <hr>
        <div class="row overview-ikb">
            <div class="col-4">
                <a href="{{ route('transaksi') }}" class="container-fluid btn btn-warning text-light text-center">
                <h4 class="pemesanan-count">{{ $transaksis->count() }}</h4>
                    <p>Pemesanan Berlangsung</p>
                </a>
            </div>

            <div class="col-4">
                <a href="#" class="container-fluid btn btn-info text-light text-center">
                <h4 class="pengiriman-count">0</h4>
                <p>Perlu Dikirim</p>
                </a>
            </div>

            <div class="col-4">
                <a href="#" class="container-fluid btn btn-danger text-light text-center">
                <h4 class="cancel-count">0</h4>
                <p>Dibatalkan</p>
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
