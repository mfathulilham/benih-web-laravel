@extends('layouts.backend.admin.master')
@section('content')

<!-- CONTENT -->

<div class="col-11 admin col-md-8 col-lg-9">
    <div class="container">

        <h3>
            <i class="far fa-handshake me-2"></i>
            Order
        </h3>

        <hr>

        <div class="row mt-4">
            <div class="col-4">
                <a href="#" class="container-fluid btn btn-warning text-light text-center">
                  <h4 class="pemesanan-count mt-5">60</h4>
                  <p>Orders</p>
                </a>
              </div>

              <div class="col-4">
                <a href="#" class="container-fluid btn btn-info text-light text-center">
                  <h4 class="pengiriman-count mt-5">7</h4>
                  <p>Today Order</p>
                </a>
              </div>

              <div class="col-4">
                <a href="#" class="container-fluid btn btn-danger text-light text-center">
                  <h4 class="cancel-count mt-5">2</h4>
                  <p>Canceled Order</p>
                </a>
              </div>
        </div>

    </div>
</div>

<!-- CONTENT END -->

@endsection
