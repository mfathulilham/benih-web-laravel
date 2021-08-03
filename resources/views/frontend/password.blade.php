@extends('layouts.frontend.transaksi_master')
@section('content')


<div class="mx-4 pt-4">
    <h3>
        <i class="fas fa-users me-2"></i>
        Ubah Password
    </h3>
    <hr>

    @if (session('msg'))
            <p class="alert alert-danger">{{ session('msg') }}</p>
    @endif


    <form method="POST" action="{{ route('home-password-update') }}" class="row g-3 mt-2">
        @csrf
        @method('PATCH')

        <div class="col-md-3">
            <label for="pass_old" class="form-label">{{ __('Password Lama') }}</label>
        </div>
        <div class="col-md-9">
            <input id="pass_old" type="password" class="form-control @error('pass_old') is-invalid @enderror" name="pass_old" value="{{ old('pass_old') }}" required>
            @error('pass_old')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label for="password" class="form-label">{{ __('Password Baru') }}</label>
        </div>
        <div class="col-md-9">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" required>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-3">
            <label for="password-confirm" class="form-label">{{ __('Konfirmasi Password') }}</label>
        </div>
        <div class="col-md-9">
            <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" autocomplete="new-password" required>
            @error('password-confirm')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-5"></div>
        <div class="col-md-5">
            <button type="submit" class="btn btn-success">Ubah Password</button>
        </div>
    </form>

</div>

@endsection
