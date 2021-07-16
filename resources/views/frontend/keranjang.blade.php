@extends('layouts.frontend.master')

@section('content')

<div class="container mt-5 pt-2">
    <div class="row mt-5">
        <div class="col card px-4 py-4">

            @if (session('msg'))
                <p class="alert alert-success">{{ session('msg') }}</p>
            @endif

            <h5 class="mb-3 text-success">Alamat Pengiriman</h5>
            <div class="row g-1">
                <div class="namaPengiriman col-12 col-md-4">
                    <p class="fw-bold">{{ $name }}</p>
                </div>
                <div class="alamatPengiriman col">
                    <p>{{ $alamat }}, Kecamatan {{ $kec }}, Kabupaten {{ $kab }}, Provinsi {{ $prov }}</p>
                </div>
                <div class="col-12 col-md-2">
                    <a href="#" class="container-fluid btn btn-success">Ubah</a>
                </div>
            </div>

        </div>
    </div>

    <div class="row mt-3">
        <div class="col card card-keranjang px-4 py-4">

            <h5 class="mb-3 text-success">Keranjang Saya</h5>

            <div class="row mt-2 mx-2 bg-light">

                <div class="col-1">
                    <p class="checkText">Pilih</p>
                </div>

                <div class="col-5">
                  <p>Produk</p>
                </div>

                <div class="col-2">
                  <p>Harga Satuan</p>
                </div>

                <div class="col-2">
                  <p>Jumlah</p>
                </div>

                <div class="col-2">
                  <p>Total Harga</p>
                </div>
            </div>

            <!-- DAFTAR KERANJANG -->
            <div class="row mx-2 mt-3 px-2 pt-4 pb-2 bg-light">

                <div class="col-1">
                    <div class="form-check">
                        <input class="form-check-input checkPilih" type="checkbox" value="" id="flexCheckDefault">
                    </div>
                </div>

                <div class="col-1 imageBenih">
                  <img src="img/carousel1.jpg" alt="">
                </div>

                <div class="col-4 titleBenih">
                  <p>Padi Inpari 32 Kemasan 5 kg</p>
                </div>

                <div class="col-2 hargaBenih">
                    <p>Rp. 50.000</p>
                </div>

                <div class="col-2 jumlahBenih">
                    <p>2</p>
                </div>

                <div class="col-2 totalBenih">
                    <p>Rp. 100.000</p>
                </div>

            </div>

            <div class="row mt-4">
                <div class="col-5"></div>
                <div class="col-3">
                  <a href="#" class="btn btn-success">Bayar Sekarang</a>
                </div>
            </div>


        </div>
    </div>

</div>

@endsection
