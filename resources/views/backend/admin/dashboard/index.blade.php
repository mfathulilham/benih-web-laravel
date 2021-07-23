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
                <a href="#" class="btnOrders container-fluid btn btn-warning text-light text-center">
                  <h4 class="pemesanan-count mt-5">60</h4>
                  <p>Orders</p>
                </a>
              </div>

              <div class="col-4">
                <a href="#" class="btnUserRegistration container-fluid btn btn-info text-light text-center">
                  <h4 class="pengiriman-count mt-5">35</h4>
                  <p>User Registration</p>
                </a>
              </div>

              <div class="col-4">
                <a href="#" class="btnVisitor container-fluid btn btn-danger text-light text-center">
                  <h4 class="cancel-count mt-5">99</h4>
                  <p>Visitor</p>
                </a>
              </div>
        </div>

        {{-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> --}}

    </div>
</div>

<!-- CONTENT END -->

@endsection
