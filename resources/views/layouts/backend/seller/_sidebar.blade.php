<div class="sidebar col-12 col-md-3 col-lg-2 bg-light sticky-top">

    <div class="flex-shrink-0 p-3">
      <ul class="list-unstyled ps-0">
        <li class="mb-1">
          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
            Home
          </button>
          {{-- <div class="collapse {{ request()->is('home') ? 'show' : '' }}" id="home-collapse"> --}}
            <div class="collapse show" id="home-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              <li>
                  <a href="{{ route('home') }}" class="link-dark rounded {{ request()->is('home') ? 'fw-bold' : '' }}">Perlu Penanganan</a>
              </li>
              {{-- <li><a href="#" class="link-dark rounded">Overview</a></li>
              <li><a href="#" class="link-dark rounded">Reports</a></li> --}}
            </ul>
          </div>
        </li>
        <li class="mb-1">
          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
            Transaksi
          </button>
          <div class="collapse {{ request()->is('seller_pemesanan') ? 'show' : '' }} {{ request()->is('seller_pengiriman') ? 'show' : '' }} {{ request()->is('seller_selesai') ? 'show' : '' }} {{ request()->is('seller_cancel') ? 'show' : '' }}" id="dashboard-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              {{-- <li><a href="#" class="link-dark rounded {{ request()->is('pemesanan') ? 'fw-bold' : '' }}">Pemesanan</a></li> --}}
              <li><a href="{{ route('seller_pemesanan') }}" class="link-dark rounded {{ request()->is('seller_pemesanan') ? 'fw-bold' : '' }}">Pemesanan</a></li>
              <li><a href="{{ route('seller_pengiriman') }}" class="link-dark rounded {{ request()->is('seller_pengiriman') ? 'fw-bold' : '' }}">Pengiriman</a></li>
              <li><a href="{{ route('seller_selesai') }}" class="link-dark rounded {{ request()->is('seller_selesai') ? 'fw-bold' : '' }}">Selesai</a></li>
              <li><a href="{{ route('seller_cancel') }}" class="link-dark rounded {{ request()->is('seller_cancel') ? 'fw-bold' : '' }}">Cancel</a></li>
            </ul>
          </div>
        </li>
        <li class="mb-1">
          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
            Benih
          </button>
          <div class="collapse  {{ request()->is('benih') ? 'show' : '' }} {{ request()->is('benih/*') ? 'show' : '' }}" id="orders-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              <li><a href="{{ route('benih') }}" class="link-dark rounded {{ request()->is('benih') ? 'fw-bold' : '' }}">Benih Saya</a></li>
              <li><a href="{{ route('benih-create') }}" class="link-dark rounded {{ request()->is('benih/create') ? 'fw-bold' : '' }}">Tambah Benih</a></li>
            </ul>
          </div>
        </li>
        <li class="border-top my-3"></li>
        <li class="mb-1">
          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
            Pengaturan IKB
          </button>
          <div class="collapse {{ request()->is('seller_profile') ? 'show' : '' }} {{ request()->is('seller_password') ? 'show' : '' }} {{ request()->is('seller_rekening') ? 'show' : '' }}" id="account-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              {{-- <li><a href="#" class="link-dark rounded">New...</a></li>
              <li><a href="#" class="link-dark rounded">Profile</a></li> --}}
              <li><a href="{{ route('seller_profile') }}" class="link-dark rounded {{ request()->is('seller_profile') ? 'fw-bold' : '' }}">Profile IKB</a></li>
              <li><a href="{{ route('seller_pass') }}" class="link-dark rounded {{ request()->is('seller_password') ? 'fw-bold' : '' }}">Ubah Password</a></li>
              <li><a href="{{ route('seller_rekening') }}" class="link-dark rounded {{ request()->is('seller_rekening') ? 'fw-bold' : '' }}">Ubah Rekening</a></li>
            </ul>
          </div>
        </li>
      </ul>

  </div>
