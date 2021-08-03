@extends('layouts.frontend.transaksi_master')
@section('content')


<div class="mx-4 pt-4">
    <h3>
        <i class="fas fa-users me-2"></i>
        Daftar Rekening
    </h3>
    <hr>

    @if (session('msg'))
            <p class="alert alert-success">{{ session('msg') }}</p>
        @endif

        <div class="table-responsive">
            <table class="table table-success table-striped table-bordered table-sm">
            <thead>
                <tr>
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
                <tr>
                    <td>{{ $angkaAwal++ }}</td>
                    <td>{{ $rekening->nama_rekening }}</td>
                    <td>{{ $rekening->nomor_rekening }}</td>
                    <td>
                        <div class="row g-0">
                            {{-- <div class="col">
                                <a href="{{ route('home-rekening', $rekening->id) }}" class="btn btn-secondary"><i class="far fa-edit me-2"></i>Edit</a>
                            </div> --}}
                            <div class="col">
                                <form method="POST" action="{{ route('home-rekening-delete', $rekening->id) }}">
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



    <form method="POST" action="{{ route('home-rekening-add') }}" class="row g-3 mt-2">
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

@endsection
