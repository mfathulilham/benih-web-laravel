<div class="sidebar col-12 col-md-2 bg-light sticky-top">

    <div class="d-flex flex-column p-3">
        <ul class="nav nav-pills flex-column mb-auto mx-auto">
            <li class="text-center my-4 mt-5">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=d5d657&color=fff" alt="" width="80" height="80" class="rounded-circle me-2">
            </li>
            <li class="nav-item">
                <a href="{{ route('pemesanan') }}" class="text-dark text-decoration-none {{ request()->is('pemesanan','pengiriman','cancel','selesai') ? 'fw-bold' : '' }}">
                    <i class="far fa-clipboard me-2"></i>Transaksi
                </a>
            </li>
            <li class="nav-item my-2">
                <a href="{{ route('home-profile') }}" class=" text-dark text-decoration-none {{ request()->is('profile') ? 'fw-bold' : '' }}">
                    <i class="far fa-user me-2"></i>Informasi Akun
                </a>
            </li>
            {{-- <li>
                <a href="#" class="text-dark text-decoration-none">
                    <i class="far fa-question-circle me-2"></i>Bantuan
                </a>
            </li> --}}
        </ul>
    </div>

</div>
