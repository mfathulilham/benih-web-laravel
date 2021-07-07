<!DOCTYPE html>
<html lang="en">
<head>

    @include('layouts.frontend._head')

</head>
<body>

    <!-- NAV -->
    @include('layouts.frontend._navbar')
    <!-- NAV END -->

    <main>

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
    <!-- Carousel End -->

    <!-- Kategori -->
    <section>
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
    </section>

    <hr class="mx-4 mt-5 text-secondary">

    @yield('content')

    </main>

    @include('layouts.frontend._footer')


    @include('layouts.frontend._script')

</body>
</html>
