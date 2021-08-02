@extends('layouts.frontend.master')

@section('content')

<!-- Benih Card -->
<div class="benihCard mx-4 my-4 pt-5">
    <h3 class="mt-4">Hasil Pencarian untuk '{{ $search }}'</h3>
    <hr>
    <div class="row mt-3 mb-3 g-3">

        @forelse ($benihs as $benih)

        <!-- BENIH 1 -->
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card cardBenih">
            <img src="{{ $benih->img }}" class="card-img-top img-thumbnail" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ $benih->judul }}</h5>
                <div class="row g-0">
                    <div class="col">
                        <p class="harga">Rp. {{ number_format($benih->harga, 0, ',', '.') }}</p>
                    </div>
                    <div class="col">
                        <p class="card-text">
                        <i class="fas fa-star text-warning"></i>
                        0 | Terjual 0
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p class=""><i class="fas fa-map-marker-alt me-2"></i>{{ $benih->user->name }}</p>
                    </div>
                </div>
                <div class="row justify-content-center g-1">
                    @auth
                        {{-- <div class="col">
                            <a href="#" class="addKeranjangBtn container-fluid btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fas fa-plus me-1"></i>Keranjang
                            </a>
                        </div> --}}
                        <div class="col">
                            <a href="{{ route('home-detail', $benih->id) }}" class="detailBtn container-fluid btn btn-success">Detail</a>
                        </div>
                    @else
                        {{-- <div class="col">
                            <a href="{{ route('login') }}" class="addKeranjangBtn container-fluid btn btn-success">
                                <i class="fas fa-plus me-1"></i>Keranjang
                            </a>
                        </div> --}}
                        <div class="col">
                            <a href="{{ route('login') }}" class="detailBtn container-fluid btn btn-success">Detail</a>
                        </div>
                    @endauth
                </div>
            </div>
            </div>
        </div>

        @empty

        <h3 class="text-center mb-4 mt-5">Pencarian tidak ditemukan...</h3>

      @endforelse

      </div>
  </div>
  <!-- Benih Card End -->


@endsection
