@extends('layouts.backend.admin.master')
@section('content')
<!-- CONTENT -->

<div class="col-11 admin col-md-8 col-lg-9">
    <div class="container">

        <h3>
            <i class="fas fa-users me-2"></i>
            IKB Accounts
        </h3>

        @if (session('msg'))
            <p class="alert alert-success">{{ session('msg') }}</p>
        @endif

        <hr>
        <div class="row mt-4 mb-3">
            <div class="col">
            </div>
            <div class="col-md-5 col-lg-2">
                <a href="{{ route('seller-create')}}" class="container-fluid btn btn-success"><i class="fas fa-plus me-2"></i>Add Account</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-success table-bordered table-sm">
            <thead>
                <tr class="align-top text-center">
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
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
                @forelse ($sellers as $seller)
                <tr>
                    <td>{{ $angkaAwal++ }}</td>
                    <td>{{ $seller->name }}</td>
                    <td>{{ $seller->email }}</td>
                    <td>{{ $seller->telp }}</td>
                    <td>{{ $seller->alamat }}</td>
                    <td>{{ $seller->prov }}</td>
                    <td>{{ $seller->kab }}</td>
                    <td>{{ $seller->kec }}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('seller-edit', $seller->id) }}" class="btn btn-secondary"><i class="far fa-edit"></i></a>
                            <form method="POST" action="{{ route('seller-delete', $seller->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Want to delete ?')" type="submit"><i class="far fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <td colspan="9">
                    <p class="text-center mt-3">Belum Ada Data IKB</p>
                </td>
                @endforelse
            </tbody>
            </table>
        </div>

    </div>
</div>

<!-- CONTENT END -->

@endsection
