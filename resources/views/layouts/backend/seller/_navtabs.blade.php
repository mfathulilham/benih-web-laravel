<div class="col-12">
    <ul class="nav nav-tabs navTabs">
        <li class="nav-item">
            <a class="nav-link text-success {{ request()->is('transaksi') ? 'active' : '' }}" aria-current="page" href="{{ route('transaksi') }}">Pemesanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-success {{ request()->is('transaksi/pengiriman') ? 'active' : '' }}" aria-current="page" href="{{ route('transaksi-pengiriman') }}">Pengiriman</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-success" href="#">Selesai</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-success" href="#">Cancel</a>
        </li>
    </ul>
</div>
