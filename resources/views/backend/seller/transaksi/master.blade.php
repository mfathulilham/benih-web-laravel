@extends('layouts.backend.seller.master')
@section('content')

<div class="col-12 ikb-content ikb-transaksi col-md-8 col-lg-9 pb-3">
    <div class="container">
      <main class="card-content pb-3">

          <!-- NAV Tab -->
          @include('layouts.backend.seller._navtabs')


          <!-- Data Pemesanan -->

          {{-- <div class="row mx-3 mt-4 text-success">
              <h3>Pengiriman</h3>
          </div> --}}

          <div class="row g-0 mx-4 mt-3">
              <div class="col">
                  <input class="form-control me-2" type="search" placeholder="Cari..." aria-label="Search">
              </div>
              <div class="col-2 col-md-2 col-lg-1">
                  <button class="btn btn-outline-success" type="submit">Search</button>
              </div>
          </div>

          @yield('content-transaksi')


      </main>
  </div>
</div>


@endsection
