@extends('layouts.backend.admin.master')
@section('content')

<!-- CONTENT -->

<div class="col-11 admin col-md-8 col-lg-9">
    <div class="container">

        <h3>
            <i class="fas fa-users me-2"></i>
            Customer Accounts
        </h3>

        @if (session('msg'))
            <p class="alert alert-success">{{ session('msg') }}</p>
        @endif

        <hr>

        <div class="table-responsive">
            <table class="table table-hover table-success table-striped table-bordered table-sm">
                <thead>
                    <tr class="align-top text-center">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>TTL</th>
                    <th>No. WA</th>
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
                    @forelse ($customers as $customer)
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
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('customer-edit', $customer->id) }}" class="btn btn-secondary"><i class="far fa-edit"></i></a>
                                    <form method="POST" action="{{ route('customer-delete', $customer->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" onclick="return confirm('Want to delete ?')" type="submit"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                    <td colspan="10">
                        <p class="text-center mt-3">Belum Ada Data Customers</p>
                    </td>
                    @endforelse

                </tbody>
            </table>
          </div>

    </div>
</div>

<!-- CONTENT END -->

@endsection
