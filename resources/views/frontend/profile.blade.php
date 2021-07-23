@extends('layouts.frontend.transaksi_master')
@section('content')


<div class="mx-4 pt-4">
    <h3>
        <i class="fas fa-users me-2"></i>
        Profile Saya
    </h3>
    <hr>

    <form method="POST" action="/transaksi/update/{{ $user->id }}" class="row g-3">
        @csrf
        @method('patch')

        <div class="col-md-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
        </div>
        <div class="col-md-9">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')?? $user->name  }}" required autocomplete="name" autofocus>

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
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email')?? $user->email }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        {{-- <div class="col-md-3">
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
        </div> --}}
        <div class="col-md-3">
            <label for="lahir" class="form-label">{{ __('Tanggal Lahir') }}</label>
        </div>
        <div class="col-md-9">
            <input type="date" class="form-control @error('date') is-invalid @enderror" id="lahir" name="lahir" value="{{ old('lahir')?? $user->lahir }}" required>
            @error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label for="telp" class="form-label">{{ __('Telepon') }}</label>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control @error('telp') is-invalid @enderror" id="telp" name="telp" value="{{ old('telp')?? $user->telp }}" required>
            @error('telp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label for="alamat" class="form-label">{{ __('Alamat') }} </label>
        </div>
        <div class="col-md-9">
            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" rows="2" placeholder="Nama Jalan/Gedung/Penanda Lain" name="alamat" required>{{ old('alamat')?? $user->alamat }}</textarea>
            @error('alamat')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label for="prov" class="form-label">{{ __('Provinsi') }}</label>
        </div>
        <div class="col-md-9">
            <input type="text" class="form-control @error('prov') is-invalid @enderror" id="prov" placeholder="Provinsi" name="prov" value="{{ old('prov')?? $user->prov }}" required>
            @error('prov')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label for="prov" class="form-label">{{ __('Kab/Kota-Kecamatan') }}</label>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control @error('kab') is-invalid @enderror" id="kab" placeholder="Kabupaten" name="kab" value="{{ old('kab')?? $user->kab }}" required>
            @error('kab')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-5">
            <input type="text" class="form-control @error('kec') is-invalid @enderror" id="kec" placeholder="Kecamatan" name="kec" value="{{ old('kec')?? $user->kec }}" required>
            @error('kec')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        {{-- ROLE --}}
        <div class="col-md-5">
            <input type="number" class="form-control" id="role" value="1" name="role" hidden>
        </div>

        <div class="col-3">
            <button type="submit" class="btn btn-success">
                Ubah Profile
            </button>
        </div>

    </form>
</div>

@endsection
