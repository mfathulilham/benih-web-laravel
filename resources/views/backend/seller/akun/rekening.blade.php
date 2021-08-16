@extends('layouts.backend.seller.master')
@section('content')

<div class="col-12 ikb-content col-md-8 col-lg-9 pb-3">
    <div class="container">
        <h3 class="mb-3 mt-3"> <i class="fas fa-users me-2"></i>Profile IKB</h3>

        <hr>

        @if (session('msg'))
            <p class="alert alert-success">{{ session('msg') }}</p>
        @elseif (session('err'))
            <p class="alert alert-danger">{{ session('err') }}</p>
        @endif

        <div class="table-responsive">
            <table class="table table-success table-striped table-bordered table-sm">
            <thead>
                <tr class="align-top text-center">
                    <th>No</th>
                    <th>Nama Rekening</th>
                    <th>Nomor Rekening</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $angkaAwal = 1
                @endphp
                @forelse ($rekenings as $rekening)
                <tr class="text-center">
                    <td>{{ $angkaAwal++ }}</td>
                    <td>{{ $rekening->nama_rekening }}</td>
                    <td>{{ $rekening->nomor_rekening }}</td>
                    <td>
                        <div class="row g-0">
                            {{-- <div class="col">
                                <a href="{{ route('home-rekening', $rekening->id) }}" class="btn btn-secondary"><i class="far fa-edit me-2"></i>Edit</a>
                            </div> --}}
                            <div class="col">
                                <form method="POST" action="{{ route('seller_rekening-delete', $rekening->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger" onclick="return confirm('Ingin Menghapus Rekening ?')" type="submit"><i class="far fa-trash-alt me-2"></i>Hapus</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <p class="text-center mt-3">
                                Tambah Sekarang, Belum ada data rekening
                            </p>
                        </td>

                    </tr>
                @endforelse
            </tbody>
            </table>
        </div>



    <form method="POST" action="{{ route('seller_rekening-add') }}" class="row g-3 mt-2">
        @csrf
        <div class="col-md-12">
            <h5>Tambah Rekening</h5>
        </div>
        <div class="col-md-3">
            <label for="nama_rekening" class="form-label">{{ __('Nama Rekening') }}</label>
        </div>
        <div class="col-md-9">
            <select class="form-select @error('nama_rekening') is-invalid @enderror" aria-label="Default select example" id="nama_rekening" name="nama_rekening">
                <option value="BNI">BNI</option>
                <option value="BRI">BRI</option>
            </select>
            @error('nama_rekening')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label for="nomor_rekening" class="form-label">{{ __('Nama Pemilik') }}</label>
        </div>
        <div class="col-md-9">
            <input id="nama_pemilik" type="text" class="form-control @error('nama_pemilik') is-invalid @enderror" name="nama_pemilik" value="{{ old('nama_pemilik') }}">
            @error('nama_pemilik')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label for="nomor_rekening" class="form-label">{{ __('Nomor Rekening') }}</label>
        </div>
        <div class="col-md-9">
            <input id="nomor_rekening" type="text" class="form-control @error('nomor_rekening') is-invalid @enderror" name="nomor_rekening" value="{{ old('nomor_rekening') }}">
            @error('nomor_rekening')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-5"></div>
        <div class="col-md-5">
            <button type="submit" class="btn btn-success">Tambah Rekening</button>
        </div>
    </form>
  </div>
</div>

@endsection
