@extends('layouts.app')

@section('content')
<div id="test" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-light bg-success">{{ __('Daftar Akun') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Alamat E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Ulangi Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lahir" class="col-md-4 col-form-label text-md-right">{{ __('Lahir') }}</label>

                            <div class="col-md-6">
                                <input id="lahir" type="date" class="form-control" name="lahir" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telp" class="col-md-4 col-form-label text-md-right">{{ __('Nomor Whatsapp') }}</label>

                            <div class="col-md-6">
                                <input id="telp" type="text" class="form-control" name="telp" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat" class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>

                            <div class="col-md-6">
                                <textarea name="alamat" id="alamat" class="form-control" placeholder="Nama Jalan/Gedung/Penanda"></textarea>
                            </div>
                        </div>

                        <div class="form-group row" >
                            <label for="prov" class="col-md-4 col-form-label text-md-right">{{ __('Provinsi') }} </label>

                            <div class="col-md-6">
                                <select onchange="loadKabupaten()" name="prov" class="form-control" id="provcoba"></select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kab" class="col-md-4 col-form-label text-md-right">{{ __('Kabupaten\Kota') }}</label>

                            <div class="col-md-6">
                                <select onchange="loadKecamatan()" name="kab" id="kabcoba" class="form-control">
                                    <option disabled>Pilih Provinsi Dulu</option>
                                </select>
                                {{-- <input id="kab" type="text" class="form-control" name="kab" required> --}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kec" class="col-md-4 col-form-label text-md-right">{{ __('Kecamatan') }}</label>

                            <div class="col-md-6">
                                <select name="kec" id="keccoba" class="form-control">
                                    <option disabled>Pilih Kabupaten Dulu</option>
                                </select>
                                {{-- <input id="kec" type="text" class="form-control" name="kec" required> --}}
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Daftar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('vuejs')
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
{{-- <script>
    new Vue({
        el: '#test',
        data(){
            return {
                sapi:'',
                provinsi:[]
            }
        },
        methods:{
            loadProvinsi:function(){
                console.log("asd")
                fetch('https://dev.farizdotid.com/api/daerahindonesia/provinsi').then(data => data.json()).then(data => this.provinsi = data)
            },
        },
    })
</script> --}}
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
@endpush
@endsection






{{-- SUARMIN TERAKHIR UNTUK DAPAT API DARI RAJA ONGKIR
                        <div class="form-group row">
                            <label for="kab" class="col-md-4 col-form-label text-md-right">{{ __('Kabupaten\Kota') }}</label>

                            <div class="col-md-6">
                                <select onchange="loadKecamatan()" name="kab" id="kabcoba" class="form-control"></select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('vuejs')
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script>
    new Vue({
        el: '#test',
        data(){
            return {
                sapi:'',
                provinsi:[]
            }
        },
        methods:{
            loadProvinsi:function(){
                console.log("asd")
                fetch('https://dev.farizdotid.com/api/daerahindonesia/provinsi').then(data => data.json()).then(data => this.provinsi = data)
            },
        },
    })
</script>
<script>
    function loadKabupaten(){
        let kab = document.getElementById('kabcoba');
        kab.innerHTML = '';
        fetch('https://api.rajaongkir.com/starter/city?province=28',{
            mode:'cors',
            headers:{
                'key': '58fd02cea4959108f86597972e692176',
            },
        }).then(data => data.json()).then(data =>{ console.log(data); data.rajaongkir.results.map(e => kab.innerHTML +=`<option value="${e.city_name},${e.city_id}">${e.city_name}</option>`)})
    }
    document.addEventListener("DOMContentLoaded", function() {
        loadKabupaten();
    });
</script>
@endpush
@endsection --}}
