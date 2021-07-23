@extends('layouts.frontend.master')

@section('content')

<!-- Carousel -->
<div id="carouselExampleIndicators" class="carousel slide pt-4 mx-4" data-bs-ride="carousel">
    <div class="carousel-indicators ">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner mt-5">
      <div class="carousel-item active">
        <img src="img/carousel4.jpg" class="d-block w-100" alt="Benih 1">
      </div>
      <div class="carousel-item">
        <img src="img/carousel5.jpg" class="d-block w-100" alt="Benih 2">
      </div>
      <div class="carousel-item">
        <img src="img/carousel6.jpg" class="d-block w-100" alt="Benih 3">
      </div>
    </div>
</div>

<!-- Kategori -->
{{-- <section>
    <div class="category mx-4 mt-5">
      <div class="row card-2 px-3 pt-2 py-3 mx-1 g-3">
        <h3 class="my-3">Kategori Benih</h3>

        <div class="col-6 col-md-3">
          <div class="card text-center">
            <h1>
              <i class="fas fa-seedling text-danger card-img-top mt-5"></i>
            </h1>
            <div class="card-body">
              <h5 class="card-title">Padi</h5>
              <p class="card-text">Inpari, Ciherang Dll</p>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="card text-center">
            <h1>
              <i class="fas fa-seedling text-warning card-img-top mt-5"></i>
            </h1>
            <div class="card-body">
              <h5 class="card-title">Jagung</h5>
              <p class="card-text">Landu, Cikuyi Dll</p>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="card text-center">
            <h1>
              <i class="fas fa-seedling text-secondary card-img-top mt-5"></i>
            </h1>
            <div class="card-body">
              <h5 class="card-title">Kedelai</h5>
              <p class="card-text">Kasa, Ciafe Dll</p>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="card text-center">
            <h1>
              <i class="fas fa-seedling text-success card-img-top mt-5"></i>
            </h1>
            <div class="card-body">
              <h5 class="card-title">Kacang</h5>
              <p class="card-text">Cisadane, Luwu Dll</p>
            </div>
          </div>
        </div>

      </div>
    </div>
</section> --}}

<hr class="mx-4 mt-5 text-secondary">

<!-- Benih Card -->
<div class="benihCard mx-4 my-4">
    <h3 class="mt-4">Benih Tersedia</h3>
    <div class="row mt-3 mb-3 g-3">

        @foreach ($benihs as $benih)

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
                <div class="row justify-content-center g-1">
                    @auth
                        {{-- <div class="col">
                            <a href="#" class="addKeranjangBtn container-fluid btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fas fa-plus me-1"></i>Keranjang
                            </a>
                        </div> --}}
                        <div class="col">
                            <a href="{{ route('home-detail', $benih->id) }}" class="detailBtn container-fluid btn btn-secondary">Detail</a>
                        </div>
                    @else
                        {{-- <div class="col">
                            <a href="{{ route('login') }}" class="addKeranjangBtn container-fluid btn btn-success">
                                <i class="fas fa-plus me-1"></i>Keranjang
                            </a>
                        </div> --}}
                        <div class="col">
                            <a href="{{ route('login') }}" class="detailBtn container-fluid btn btn-secondary">Detail</a>
                        </div>
                    @endauth
                </div>
            </div>
            </div>
        </div>
      @endforeach

      </div>
  </div>
  <!-- Benih Card End -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Masukkan ke keranjang</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-7">
                    Benih Inpari
                </div>
                <div class="col-3">
                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" placeholder="Jumlah" required>
                    @error('jumlah')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
            <button type="submit" class="btn btn-primary">Masukkan</button>
          </div>
        </div>
      </div>
    </div>
  <!-- DETAIL Benih End -->

@endsection
