@extends('layouts.backend.seller.master')
@section('content')

<div class="col-12 ikb-content col-md-8 col-lg-9 pb-3">
    <div class="container">
        <h3 class="mb-3 mt-3"> <i class="fas fa-users me-2"></i>Profile IKB</h3>

        <hr>

        @if (session('msg'))
                <p class="alert alert-success">{{ session('msg') }}</p>
        @endif

        <form method="POST" action="{{ route('seller_profile-update') }}" class="row g-3">
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
                <input class="form-control" value="{{ $user->email }}" required autocomplete="email" disabled>
            </div>
            <div class="col-md-3">
                <label for="telp" class="form-label">{{ __('Nomor Whatsapp') }}</label>
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
                {{-- <input type="text" class="form-control @error('prov') is-invalid @enderror" id="prov" placeholder="Provinsi" name="prov" value="{{ old('prov')?? $user->prov }}" required> --}}
                <select onchange="loadKabupaten()" name="prov" class="form-control" id="provcoba">
                    <option value="{{ old('prov')?? $user->prov }}">{{ old('prov')?? $user->prov }}</option>
                </select>
                @error('prov')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="prov" class="form-label">{{ __('Kab-Kota / Kecamatan') }}</label>
            </div>
            <div class="col-md-4">
                {{-- <input type="text" class="form-control @error('kab') is-invalid @enderror" id="kab" placeholder="Kabupaten" name="kab" value="{{ old('kab')?? $user->kab }}" required> --}}
                <select onchange="loadKecamatan()" name="kab" id="kabcoba" class="form-control">
                    <option value="{{ old('kab')?? $user->kab }}">{{ old('kab')?? $user->kab }}</option>
                </select>
                @error('kab')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-5">
                {{-- <input type="text" class="form-control @error('kec') is-invalid @enderror" id="kec" placeholder="Kecamatan" name="kec" value="{{ old('kec')?? $user->kec }}" required> --}}
                <select name="kec" id="keccoba" class="form-control">
                    {{-- <option disabled>Pilih Kabupaten Dulu</option> --}}
                    <option value="{{ old('kec')?? $user->kec }}">{{ old('kec')?? $user->kec }}</option>
                </select>
                @error('kec')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-4"></div>
            <div class="col-4">
                <button type="submit" class="btn btn-success me-2">
                    Ubah Profile
                </button>
                {{-- <div class="d-flex justify-content-center mt-2">
                    <a class="btn btn-secondary" href="{{ route('home-password') }}">
                        Ubah Password
                    </a>
                </div> --}}
            </div>

        </form>
  </div>
</div>


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
        let kec = document.getElementById('keccoba');
        kec.value='';
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
