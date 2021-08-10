@extends('layouts.backend.admin.master')
@section('content')
<!-- CONTENT -->

<div class="col-11 admin col-md-8 col-lg-9">
    <div class="container">
        <h3>
            <i class="fas fa-users me-2"></i>
            Edit Account
        </h3>
        <hr>

        <div class="row justify-content-center mt-4">
            <div class="col card-2">
                <form method="POST" action="/customer/update/{{ $customer->id }}" class="row g-3">
                    @csrf
                    @method('patch')

                    <div class="col-md-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                    </div>
                    <div class="col-md-9">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')?? $customer->name  }}" required autocomplete="name" autofocus>

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
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email')?? $customer->email }}" required autocomplete="email">

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
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

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
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                    </div>
                    <div class="col-md-3">
                        <label for="lahir" class="form-label">{{ __('Tanggal Lahir') }}</label>
                    </div>
                    <div class="col-md-9">
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="lahir" name="lahir" value="{{ old('lahir')?? $customer->lahir }}" required>
                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="telp" class="form-label">{{ __('Nomor Whatsapp') }}</label>
                    </div>
                    <div class="col-md-9">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">+62</span>
                            <input type="text" class="form-control @error('telp') is-invalid @enderror" id="telp" name="telp" value="{{ old('telp')?? $customer->telp }}" required>
                            @error('telp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="alamat" class="form-label">{{ __('Alamat') }} </label>
                    </div>
                    <div class="col-md-9">
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" rows="2" placeholder="Nama Jalan/Gedung/Penanda Lain" name="alamat" required>{{ old('alamat')?? $customer->alamat }}</textarea>
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="prov" class="form-label">{{ __('Provinsi\Kab Kota\Kecamatan') }}</label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control @error('prov') is-invalid @enderror" id="prov" placeholder="Provinsi" name="prov" value="{{ old('prov')?? $customer->prov }}" required>
                        @error('prov')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control @error('kab') is-invalid @enderror" id="kab" placeholder="Kabupaten" name="kab" value="{{ old('kab')?? $customer->kab }}" required>
                        @error('kab')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control @error('kec') is-invalid @enderror" id="kec" placeholder="Kecamatan" name="kec" value="{{ old('kec')?? $customer->kec }}" required>
                        @error('kec')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">
                                Simpan
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

<!-- CONTENT END -->

@endsection
