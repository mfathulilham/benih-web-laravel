@extends('layouts.backend.seller.master')
@section('content')

<div class="col-12 ikb-content col-md-8 col-lg-9 pb-3">
    <div class="container">
        <h3 class="mb-3 mt-3">Perlu Penanganan</h3>
        <hr>
        <div class="row overview-ikb">
            <div class="col-4">
                <a href="{{ route('seller_pemesanan') }}" class="container-fluid btn btn-info text-light text-center">
                <h4 class="pemesanan-count">{{ $pemesanan->count() }}</h4>
                    <p>Pemesanan Berlangsung</p>
                </a>
            </div>

            <div class="col-4">
                <a href="{{ route('seller_pengiriman') }}" class="container-fluid btn btn-info text-light text-center">
                <h4 class="pengiriman-count">{{ $pengiriman->count() }}</h4>
                <p>Perlu Dikirim</p>
                </a>
            </div>

            <div class="col-4">
                <a href="{{ route('benih') }}" class="container-fluid btn btn-info text-light text-center">
                <h4 class="cancel-count">{{ $benih->count() }}</h4>
                <p>Benih Tersedia</p>
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
