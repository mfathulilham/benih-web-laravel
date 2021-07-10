@extends('layouts.backend.seller.master')
@section('content')

<div class="col-12 ikb-content ikb-transaksi col-md-8 col-lg-9 pb-3">
    <div class="container">
      <main class="card-content pb-3">

          <!-- Search -->
          <div class="row g-0 mx-3 pt-3">
              <div class="col">
                  <input class="form-control me-2" type="search" placeholder="Temukan Benih" aria-label="Search">
              </div>
              <div class="col-2 col-lg-1">
                  <button class="btn btn-outline-success" type="submit">Search</button>
              </div>
          </div>

          <!-- Button Add Benih -->
          <div class="row mx-3 mt-5 mb-3">
              <div class="col">
                  <h5>4 Produk</h5>
              </div>
              <div class="col-md-5 col-lg-3">
                  <a href="{{ route('benih-create') }}" class="container-fluid btn btn-success"><i class="fas fa-plus me-2"></i>Tambah Benih</a>
              </div>
          </div>

          <!-- BENIH SAYA -->
          <div class="row g-2 benihCard mx-3 my-2">

              <!-- BENIH 1 -->
              <div class="col-6 col-md-4 col-lg-3">
                  <div class="card cardBenih">
                    <img src="img/carousel2.jpg" class="card-img-top img-thumbnail" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Benih Padi Varietas Inpari 32 Label BP</h5>
                      <div class="row g-0">
                        <div class="col">
                          <p class="harga">Rp. 50.000</p>
                        </div>
                        <div class="col">
                          <div class="card-stok text-end">
                              <p>Stok 50</p>
                          </div>
                      </div>
                      <div class="row g-0">
                          <div class="col">
                              <p class="card-text text-end mb-3">
                                  <i class="fas fa-star text-warning"></i>
                                  5.0 | Terjual 100
                              </p>
                          </div>
                      </div>
                      <div class="row justify-content-center g-0">
                        <div class="col">
                          <a href="#" class="container-fluid btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</a>
                        </div>
                        <div class="col">
                          <a href="#" class="container-fluid btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Hapus</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- BENIH 2 -->
              <div class="col-6 col-md-4 col-lg-3">
                  <div class="card cardBenih">
                    <img src="img/carousel2.jpg" class="card-img-top img-thumbnail" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Benih Padi Varietas Inpari 32 Label BP</h5>
                      <div class="row g-0">
                        <div class="col">
                          <p class="harga">Rp. 50.000</p>
                        </div>
                        <div class="col">
                          <div class="card-stok text-end">
                              <p>Stok 50</p>
                          </div>
                      </div>
                      <div class="row g-0">
                          <div class="col">
                              <p class="card-text text-end mb-3">
                                  <i class="fas fa-star text-warning"></i>
                                  5.0 | Terjual 100
                              </p>
                          </div>
                      </div>
                      <div class="row justify-content-center g-0">
                        <div class="col">
                          <a href="#" class="container-fluid btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</a>
                        </div>
                        <div class="col">
                          <a href="#" class="container-fluid btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Hapus</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- BENIH 3 -->
              <div class="col-6 col-md-4 col-lg-3">
                  <div class="card cardBenih">
                    <img src="img/carousel2.jpg" class="card-img-top img-thumbnail" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Benih Padi Varietas Inpari 32 Label BP</h5>
                      <div class="row g-0">
                        <div class="col">
                          <p class="harga">Rp. 50.000</p>
                        </div>
                        <div class="col">
                          <div class="card-stok text-end">
                              <p>Stok 50</p>
                          </div>
                      </div>
                      <div class="row g-0">
                          <div class="col">
                              <p class="card-text text-end mb-3">
                                  <i class="fas fa-star text-warning"></i>
                                  5.0 | Terjual 100
                              </p>
                          </div>
                      </div>
                      <div class="row justify-content-center g-0">
                        <div class="col">
                          <a href="#" class="container-fluid btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</a>
                        </div>
                        <div class="col">
                          <a href="#" class="container-fluid btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Hapus</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- BENIH 4 -->
              <div class="col-6 col-md-4 col-lg-3">
                  <div class="card cardBenih">
                    <img src="img/carousel2.jpg" class="card-img-top img-thumbnail" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Benih Padi Varietas Inpari 32 Label BP</h5>
                      <div class="row g-0">
                        <div class="col">
                          <p class="harga">Rp. 50.000</p>
                        </div>
                        <div class="col">
                          <div class="card-stok text-end">
                              <p>Stok 50</p>
                          </div>
                      </div>
                      <div class="row g-0">
                          <div class="col">
                              <p class="card-text text-end mb-3">
                                  <i class="fas fa-star text-warning"></i>
                                  5.0 | Terjual 100
                              </p>
                          </div>
                      </div>
                      <div class="row justify-content-center g-0">
                        <div class="col">
                          <a href="#" class="container-fluid btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</a>
                        </div>
                        <div class="col">
                          <a href="#" class="container-fluid btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Hapus</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

          </div>

      </main>
  </div>
  </div>
@endsection
