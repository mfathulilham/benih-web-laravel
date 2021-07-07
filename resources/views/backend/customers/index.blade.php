@extends('layouts.backend.master')
@section('content')

<!-- CONTENT -->

<div class="col-11 admin col-md-8 col-lg-9">
    <div class="container">

        <h3>
            <i class="fas fa-users me-2"></i>
            Customer Accounts
        </h3>

        <hr>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Rek</th>
                  <th>No. Rek</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td>1</td>
                    <td>Mark</td>
                    <td>mark@gmail.com</td>
                    <td>BNI</td>
                    <td>01238129</td>
                    <td>Makassar</td>
                    <td>
                        <a href="#" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Mark</td>
                    <td>mark@gmail.com</td>
                    <td>BNI</td>
                    <td>01238129</td>
                    <td>Makassar</td>
                    <td>
                        <a href="#" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Mark</td>
                    <td>mark@gmail.com</td>
                    <td>BNI</td>
                    <td>01238129</td>
                    <td>Makassar</td>
                    <td>
                        <a href="#" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
              </tbody>
            </table>
          </div>

    </div>
</div>

<!-- CONTENT END -->

@endsection
