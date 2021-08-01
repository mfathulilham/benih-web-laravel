@extends('layouts.backend.admin.master')
@section('content')

<!-- CONTENT -->

<div class="col-11 admin col-md-8 col-lg-9">
    <div class="container">

        <h3>
            <i class="fas fa-home me-2"></i>
            Dashboard
        </h3>

        <hr>

        <div class="row mt-4">
            <div class="col-4">
                <a href="#" class="btnOrders container-fluid btn btn-info text-light text-center">
                  <h4 class="pemesanan-count mt-5">{{ $selesai->count() }}</h4>
                  <p>Transaksi</p>
                </a>
              </div>

              <div class="col-4">
                <a href="#" class="btnUserRegistration container-fluid btn btn-info text-light text-center">
                  <h4 class="pengiriman-count mt-5">{{ $user->count() }}</h4>
                  <p>User Registration</p>
                </a>
              </div>

              <div class="col-4">
                <a href="#" class="btnVisitor container-fluid btn btn-info text-light text-center">
                  <h4 class="cancel-count mt-5">{{ $benih->count() }}</h4>
                  <p>Benih Tersedia</p>
                </a>
              </div>
        </div>

        {{-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> --}}

    </div>
</div>

<!-- CONTENT END -->

@endsection
