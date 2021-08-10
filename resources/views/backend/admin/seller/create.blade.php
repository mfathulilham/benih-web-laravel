@extends('layouts.backend.admin.master')
@section('content')
<!-- CONTENT -->

<div class="col-11 admin col-md-8 col-lg-9">
    <div class="container">
        <h3>
            <i class="fas fa-users me-2"></i>
            Add Account
        </h3>
        <hr>
        {{-- @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        @endif --}}

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
                        <input id="password-confirm" type="password" class="form-control @error('name') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                        @error('password-confirm')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="telp" class="form-label">{{ __('Nomor Whatsapp') }}</label>
                    </div>
                    <div class="col-md-9">
                        <input type="number" class="form-control @error('telp') is-invalid @enderror" id="telp" value="{{ old('telp') }}" name="telp" required>
                        @error('telp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="alamat" class="form-label">{{ __('Alamat') }}</label>
                    </div>
                    <div class="col-md-9">
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" rows="2" placeholder="Nama Jalan/Gedung/Penanda Lain" name="alamat" required>{{ old('email') }}</textarea>
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
                        {{-- <input type="text" class="form-control @error('prov') is-invalid @enderror" id="prov" placeholder="Provinsi" name="prov" value="{{ old('prov') }}" required> --}}
                        <select onchange="loadKabupaten()" name="prov" class="form-control" id="provcoba"></select>
                        @error('prov')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        {{-- <input type="text" class="form-control @error('kab') is-invalid @enderror" id="kab" placeholder="Kabupaten" name="kab" value="{{ old('kab') }}" required> --}}
                        <select onchange="loadKecamatan()" name="kab" id="kabcoba" class="form-control">
                            <option disabled>Pilih Provinsi Dulu</option>
                        </select>
                        @error('kab')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        {{-- <input type="text" class="form-control @error('kec') is-invalid @enderror" id="kec" placeholder="Kecamatan" name="kec" value="{{ old('kec') }}" required> --}}
                        <select name="kec" id="keccoba" class="form-control">
                            <option disabled>Pilih Kabupaten Dulu</option>
                        </select>
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

{{-- PROVINSI --}}

<script>
    function loadProvinsiCoba(){
        let prov = document.getElementById('provcoba');
        fetch('https://dev.farizdotid.com/api/daerahindonesia/provinsi').then(data => data.json()).then(data => data.provinsi.map(e => prov.innerHTML +=`<option value="${e.nama},${e.id}">${e.nama}</option>`))
    }
    function loadKabupaten(){
        let kab = document.getElementById('kabcoba');
        kab.innerHTML = '';
        let prov = document.getElementById('provcoba');
        prov = prov.value;
        prov = prov.split(',');
        fetch('https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi='+prov[1]).then(data => data.json()).then(data => data.kota_kabupaten.map(e => kab.innerHTML +=`<option value="${e.nama},${e.id}">${e.nama}</option>`))
    }

    function loadKecamatan(){
        let kec = document.getElementById('keccoba');
        kec.innerHTML = '';
        let kab = document.getElementById('kabcoba');
        kab = kab.value;
        kab = kab.split(',');
        fetch('https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota='+kab[1]).then(data => data.json()).then(data => data.kecamatan.map(e => kec.innerHTML +="<option value="+e.nama+">"+e.nama+"</option>"))
    }
    document.addEventListener("DOMContentLoaded", function() {
        loadProvinsiCoba();
    });
</script>

@endsection
