<div class="sidebar col-12 col-md-2 bg-light">

    <div class="d-flex flex-column p-3">
        <ul class="nav nav-pills flex-column mb-auto mx-auto">
            <li class="text-center my-4">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=d5d657&color=fff" alt="" width="80" height="80" class="rounded-circle me-2">
            </li>
            <li class="nav-item">
                <a href="{{ route('transaksi-pemesanan') }}" class="text-dark text-decoration-none {{ request()->is('transaksi/*') ? 'fw-bold' : '' }}">
                    <i class="far fa-edit me-2"></i>Pesanan Saya
                </a>
            </li>
            <li class="nav-item my-2">
                <a href="{{ route('profile') }}" class=" text-dark text-decoration-none {{ request()->is('profile') ? 'fw-bold' : '' }}">
                    <i class="far fa-edit me-2"></i>Ubah Profile
                </a>
            </li>
            <li>
                <a href="#" class="text-dark text-decoration-none">
                    <i class="far fa-question-circle me-2"></i>Bantuan
                </a>
            </a>
            </li>
        </ul>
    </div>

</div>
