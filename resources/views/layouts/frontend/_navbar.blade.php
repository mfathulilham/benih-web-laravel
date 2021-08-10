<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-success text-light px-5">
    <h3>
      <i class="fas fa-seedling"></i>
      <a class="navbar-brand text-light" href="/">BenihKu</a>
    </h3>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <form class="nav-item d-flex form-control-sm me-5" action="{{ route('home-search') }}" method="GET">
            @csrf
            <input class="searchInput form-control me-2 ps-4 pe-5" type="search" placeholder="Temukan Benih..." aria-label="Search" name="search" required>

            @auth
            <button class="btn btn-outline-light" type="submit">
                Cari
            </button>
            @else
            <a class="btn btn-outline-light" href="{{ route('login') }}">
                Cari
            </a>
            @endauth
        </form>
        @auth
        {{-- Show Dashboard For Admin--}}
        @if (Auth::user()->role == 2)
            <li class="nav-item ms-4 mt-1">
                <a href="{{ route('dashboard') }}" class="keranjangBtn nav-link text-light">
                <i class="fas fa-home me-2"></i>
                Dashboard
                </a>
            </li>
        @endif

            <li class="nav-item ms-4 mt-1">
                <a href="{{ route('home-keranjang') }}" class="keranjangBtn nav-link text-light">
                <i class="fas fa-shopping-cart"></i>
                Keranjang
                @if (Auth::user()->keranjangs()->where('status','keranjang')->count() != 0)
                    <span class="badge bg-danger rounded-pill">{{Auth::user()->keranjangs()->where('status','keranjang')->count()}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item ms-4 mt-1">
                <a href="{{ route('pemesanan') }}" class="notifikasiBtn nav-link text-light">
                <i class="fas fa-shopping-bag"></i>
                Transaksi
                @if (Auth::user()->keranjangs()->where('status','!=','keranjang')->count() != 0)
                    <span class="badge bg-danger rounded-pill">{{ Auth::user()->transaksis()->where('status','Menunggu Pembayaran')->count() }}</span>
                @endif
                </a>
            </li>
            <li class="nav-item dropdown ms-3">
                <a href="#" class="nav-link d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=d5d657&color=fff" alt="" width="32" height="32" class="rounded-circle me-2">


                <!-- <strong>Logout</strong> -->
                </a>
                <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('home-profile') }}">Profile Saya</a></li>
                <li><a class="dropdown-item" href="{{ route('home-rekening') }}">Ubah Rekening</a></li>
                <li><a class="dropdown-item" href="{{ route('home-password') }}">Ubah Password</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                </ul>
            </li>
        @else
            <li class="nav-item ms-4 mt-1">
                <a href="/login" class="keranjangBtn nav-link text-light">
                Masuk
                </a>
            </li>
            <li class="nav-item ms-4 mt-1">
                <a href="{{ route('register') }}" class="notifikasiBtn nav-link text-light">
                Daftar
                </a>
            </li>
        @endauth


      </ul>
    </div>
</nav>
