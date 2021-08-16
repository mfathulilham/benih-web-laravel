@extends('layouts.frontend.master')

@section('content')

<!-- Carousel -->
<div id="carouselExampleIndicators" class="carousel slide pt-4 mx-4" data-bs-ride="carousel">
    <div class="carousel-indicators ">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    </div>
    <div class="carousel-inner mt-5">
      <div class="carousel-item active">
        <img src="img/banner2.png" class="d-block w-100" alt="Benih 1">
      </div>
      <div class="carousel-item">
        <img src="img/banner3.png" class="d-block w-100" alt="Benih 2">
      </div>
    </div>
</div>

<hr class="mx-4 mt-5 text-secondary">

<!-- Benih Card -->
<div class="benihCard mx-4 my-4">

    @auth

    {{-- KALAU BENIH TERSEDIA --}}
    @if (sizeOf($benihs) != 0)
        <h3 class="mt-4">Benih Tersedia</h3>
    @endif

    <div class="row mt-3 mb-3 g-3">

        @forelse ($benihs as $benih)

        <!-- BENIH 1 -->
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card cardBenih">
            <img src="{{ $benih->img }}" class="card-img-top img-thumbnail" alt="...">
            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <p><i class="fas fa-map-marker-alt text-success me-2"></i>{{ $benih->user->name }}</p>
                    </div>
                </div>

                <h5 class="card-title">{{ $benih->judul }}</h5>


                <div class="row g-0">
                    <div class="col">
                        <p class="harga">Rp. {{ number_format($benih->harga, 0, ',', '.') }}</p>
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-end">
                            <p class="card-text">
                            <i class="fas fa-star text-warning"></i>
                            {{($benih->rating()->avg('rating') == NULL) ? '0' : $benih->rating()->avg('rating')}} | Terjual {{$benih->terjual}}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-1">
                    @auth
                        <div class="col">
                            <a href="{{ route('home-detail', $benih->id) }}" class="detailBtn container-fluid btn btn-success">Detail</a>
                        </div>
                    @else
                        <div class="col">
                            <a href="{{ route('login') }}" class="detailBtn container-fluid btn btn-success">Detail</a>
                        </div>
                    @endauth
                </div>
            </div>
            </div>
        </div>

        @empty

        <h3 class="text-center mb-4 mt-5">Benih Belum Tersedia...</h3>

      @endforelse

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

  @else

  <h3 class="text-center mt-5">Apa itu BenihKu?</h3>
  <p class="lead mt-4 mb-5"><strong>BenihKu</strong> merupakan Platform <strong>Jual Beli benih varietas unggul tanaman pangan</strong>. Benih berasal dari <strong>27 Instalasi Kebun Benih</strong> yang berada di <strong>Sulawesi Selatan</strong> dengan proses perbanyakan benih diawasi oleh Badan Sertifikasi dan Mutu Benih (BSMB) sehingga kualitas benih dapat terjamin. Nikmati berbelanja benih unggul, daftar dan mulai transaksimu !</p>

  <hr>
  <h3 class="text-center mt-5">Benih yang Disediakan</h3>
  <section>
      <div class="row px-3 pt-2 py-3 mx-4 mt-5 g-3">

        <div class="col-6 col-md-3">
          <div class="card text-center">
            <h1>
              <i class="fas fa-spa text-success card-img-top mt-5"></i>
            </h1>
            <div class="card-body">
              <h5 class="card-title">Padi</h5>
              <p class="card-text">Varietas Inpari, Ciherang Dll</p>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="card text-center">
            <h1>
              <i class="fas fa-spa text-success card-img-top mt-5"></i>
            </h1>
            <div class="card-body">
              <h5 class="card-title">Jagung</h5>
              <p class="card-text">Varietas Lamuru, Bisma Dll</p>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="card text-center">
            <h1>
              <i class="fas fa-spa text-success card-img-top mt-5"></i>
            </h1>
            <div class="card-body">
              <h5 class="card-title">Kedelai</h5>
              <p class="card-text">Varietas Dena, Dering Dll</p>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="card text-center">
            <h1>
                <i class="fas fa-spa text-success card-img-top mt-5"></i>
            </h1>
            <div class="card-body">
              <h5 class="card-title">Kacang</h5>
              <p class="card-text">Varietas Hypoma, Vima Dll</p>
            </div>
          </div>
        </div>

      </div>
  </section>


  @endauth


@endsection
