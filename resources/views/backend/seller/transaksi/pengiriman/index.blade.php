@extends('backend.seller.transaksi.master')
@section('content-transaksi')

<div class="row list-pemesanan mx-4 my-4 px-3 py-3 bg-light">

    <div class="col-1 col-lg-1 text-success">
        <p>Id</p>
    </div>
    <div class="col-8 col-lg-9">
        <p>INV/20200717/XX/VII/586286265</p>
    </div>

    <div class="col-3 col-lg-2">
        <p>26 Jul 2021</p>
    </div>

    <hr>

    <div class="col-2 col-lg-1">
    <img src="img/carousel1.jpg" style="width: 60px; border-radius: 5px;" alt="">
    </div>

    <div class="col-10 col-lg-3 fw-bold">
    <p>Benih Padi Inpari 32 Kemasan 5 kg</p>
    </div>

    <div class="col-2"></div>

    <div class="col-1 col-lg-1 fw-light">
        <p>2</p>
    </div>

    <div class="col-1 col-lg-1 fw-light">
        <p>x</p>
    </div>

    <div class="col-4 col-lg-2 fw-light">
    <p>Rp. 100.000</p>
    </div>

    <div class="col-4 col-lg-2 fw-bold text-success">
    <p>Rp. 200.000</p>
    </div>

    <div class="col-8 col-lg-9"></div>
    <div class="col-4 col-lg-3 fw-bold">
    <p>Menunggu Pengiriman</p>
    </div>

    <hr>

    <div class="col-12">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="#" class="btn btn-success">Kirim Sekarang</a>
            <a href="#" class="btn btn-secondary">Detail</a>
            <a href="#" class="btn btn-danger">Batalkan</a>
        </div>
    </div>

</div>

@endsection
