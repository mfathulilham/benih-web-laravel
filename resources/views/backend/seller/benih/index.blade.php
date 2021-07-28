@extends('layouts.backend.seller.master')
@section('content')

<div class="col-12 ikb-content ikb-transaksi col-md-8 col-lg-9 pb-3">
    <div class="container">
      <main class="card-content pb-3">

          <!-- Search -->
          <div class="row g-0 mx-3 pt-3">
              <div class="col">
                  <input class="form-control me-2" type="search" placeholder="Temukan Benih" aria-label="Search">
              </div>
              <div class="col-2 col-lg-1">
                  <button class="btn btn-outline-success" type="submit">Search</button>
              </div>
          </div>


          <!-- Button Add Benih -->
          <div class="row mx-3 mt-5 mb-3">

            @if (session('msg'))
                <p class="alert alert-success">{{ session('msg') }}</p>
            @endif

              <div class="col">
                  <h5>{{ $benihs->count() }} Benih</h5>
              </div>
              <div class="col-md-5 col-lg-3">
                  <a href="{{ route('benih-create') }}" class="container-fluid btn btn-success"><i class="fas fa-plus me-2"></i>Tambah Benih</a>
              </div>
          </div>

          <!-- BENIH SAYA -->
          <div class="row g-2 benihCard mx-3 my-2">

            @foreach ($benihs as $benih)

              <!-- BENIH -->
              <div class="col-6 col-md-4 col-lg-3">
                  <div class="card cardBenih">
                    <img src="{{ $benih->img }}" class="card-img-top img-thumbnail" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">{{ $benih->judul }}</h5>
                      <div class="row g-0">
                        <div class="col">
                          <p class="harga">Rp. {{ number_format($benih->harga,0, ',', '.') }}</p>
                        </div>
                        <div class="col">
                          <div class="card-stok text-end">
                              <p>Stok {{ $benih->stok }}</p>
                          </div>
                      </div>
                      <div class="row g-0">
                          <div class="col">
                              <p class="card-text text-end mb-3">
                                  <i class="fas fa-star text-warning"></i>
                                  {{ $benih->rating }} | Terjual 0
                              </p>
                          </div>
                      </div>
                      <div class="row justify-content-center g-0">
                        <div class="col">
                          <a href="{{ route('benih-edit', $benih->id) }}" class="container-fluid btn btn-outline-secondary"><i class="far fa-edit me-2"></i>Edit</a>
                        </div>
                        <div class="col">
                        <form method="POST" action="{{ route('benih-delete', $benih->id) }}">
                            @csrf
                            @method('DELETE')
                                <button class="container-fluid btn btn-outline-danger" onclick="return confirm('Want to delete ?')" type="submit"><i class="far fa-trash-alt me-2"></i>Hapus</button>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            @endforeach
            <!-- BATAS BENIH -->

          </div>
          <!--BATAS BENIH SAYA -->

      </main>
  </div>
  </div>
@endsection
