@extends('layouts.backend.master')
@section('content')
<!-- CONTENT -->

<div class="col-11 admin col-md-8 col-lg-9">
    <div class="container">
        <h3>
            <i class="fas fa-users me-2"></i>
            Add Account
        </h3>
        <hr>

        <div class="row justify-content-center mt-4">
            <div class="col card-2">
                <form method="POST" action="{{ route('seller-store') }}" class="row g-3" novalidate>
                    @csrf

                    <div class="col-md-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                    </div>
                    <div class="col-md-9">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                    </div>
                    <div class="col-md-9">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                    </div>
                    <div class="col-md-9">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                    </div>
                    <div class="col-md-9">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="col-md-3">
                        <label for="telp" class="form-label">{{ __('Telepon') }}</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="telp" name="telp" required>
                    </div>
                    <div class="col-md-3">
                        <label for="alamat" class="form-label">{{ __('Alamat') }}</label>
                    </div>
                    <div class="col-md-9">
                        <textarea class="form-control" id="alamat" rows="2" placeholder="Nama Jalan/Gedung/Penanda Lain" name="alamat" required></textarea>
                    </div>
                    <div class="col-md-3">
                        <label for="prov" class="form-label">{{ __('Provinsi\Kab Kota\Kecamatan') }}</label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="prov" placeholder="Provinsi" name="prov" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="kab" placeholder="Kabupaten" name="kab" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="kec" placeholder="Kecamatan" name="kec" required>
                    </div>
                    {{-- ROLE --}}
                    <div class="col-md-5">
                        <input type="number" class="form-control" id="role" value="1" name="role" hidden>
                    </div>

                    <div class="col-3">
                        <button type="submit" class="btn btn-success">
                            Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

<!-- CONTENT END -->

@endsection
