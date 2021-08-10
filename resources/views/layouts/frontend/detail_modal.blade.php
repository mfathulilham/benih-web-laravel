<div class="modal fade" id="modalDetail{{$transaksi->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        @foreach ($transaksi->keranjang as $keranjang)
        <div class="modal-body">
            <div class="row">
                <div class="col-12 fw-bold text-success">
                    <p>Benih</p>
                </div>
                <div class="col-2">
                    <img src="{{ $keranjang->benih->img}}" style="width: 60px; height: 30px;  border-radius: 5px;" alt="">
                </div>
                <div class="col-10 fw-bold">
                    <p>{{ $keranjang->benih->judul}}</p>
                </div>

                <div class="col-2">
                </div>
                <div class="col-10">
                    <p>Kemasan {{ $keranjang->benih->variasi}} kg</p>
                </div>

                <div class="col-2"></div>

                <div class="col-1 fw-light">
                    <p>{{ $keranjang->jumlah}}</p>
                </div>

                <div class="col-1 fw-light">
                    <p>x</p>
                </div>

                <div class="col-4 fw-light">
                    <p>Rp. {{ number_format($keranjang->benih->harga, 0, ',', '.') }}</p>
                </div>

                <div class="col-4 text-success">
                    <p>Rp. {{ number_format($keranjang->total_harga, 0, ',', '.') }}</p>
                </div>
                <hr>
            </div>
            @endforeach
            <div class="row">
                <div class="col-6"></div>
                <div class="col-2 text-success">Total</div>
                <div class="col-4 fw-bold text-success">
                    <p>Rp. {{ number_format($transaksi->keranjang()->sum('total_harga'), 0, ',', '.') }}</p>
                </div>

                <hr>

                <div class="col-12 fw-bold text-success">
                    <p>Pengiriman</p>
                </div>
                <div class="col-2">
                    <p>Dari :</p>
                </div>
                <div class="col-10">
                    <p>{{ $seller->name }}, {{ $seller->alamat }} Kec. {{ $seller->kec }}, Kab. {{ $seller->kab }}</p>
                </div>
                <div class="col-2">
                    <p>Ke :</p>
                </div>
                <div class="col-10">
                    <p>{{ $user->name }}, {{ $user->alamat }} Kec. {{ $user->kec }}, Kab. {{ $user->kab }}</p>
                </div>

                {{-- <div class="col-4"></div>
                <div class="col-4 text-success">Biaya Pengiriman</div>
                <div class="col-4 text-success">
                    <p>Rp. XX.XXX</p>
                </div>

                <hr>

                <div class="col-4"></div>
                <div class="col-4 fw-bold text-success">Total Keseluruhan</div>
                <div class="col-4 fw-bold text-success">
                    <p>Rp. X.XXX.XXX</p>
                </div> --}}

            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
  </div>
</div>
