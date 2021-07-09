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
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>TTL</th>
                    <th>Telp</th>
                    <th>Alamat</th>
                    <th>Provinsi</th>
                    <th>Kabupaten</th>
                    <th>Kecamatan</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $angkaAwal = 1
                    @endphp
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $angkaAwal++ }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->lahir }}</td>
                            <td>{{ $customer->telp }}</td>
                            <td>{{ $customer->alamat }}</td>
                            <td>{{ $customer->prov }}</td>
                            <td>{{ $customer->kab }}</td>
                            <td>{{ $customer->kec }}</td>
                            <td>
                                <a href="{{ route('customer-edit', $customer->id) }}" class="btn btn-secondary"><i class="far fa-edit"></i></a>
                                <a href="#" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
          </div>

    </div>
</div>

<!-- CONTENT END -->

@endsection
