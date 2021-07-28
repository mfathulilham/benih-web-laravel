<div class="col-12">
    <ul class="nav nav-tabs navTabs">
        <li class="nav-item">
            <a class="nav-link text-success {{ request()->is('seller_pemesanan') ? 'active' : '' }}" aria-current="page" href="{{ route('seller_pemesanan') }}">Pemesanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-success {{ request()->is('seller_pengiriman') ? 'active' : '' }}" aria-current="page" href="{{ route('seller_pengiriman') }}">Pengiriman</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-success {{ request()->is('seller_selesai') ? 'active' : '' }}" aria-current="page" href="{{ route('seller_selesai') }}">Selesai</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-success {{ request()->is('seller_cancel') ? 'active' : '' }}" aria-current="page" href="{{ route('seller_cancel') }}">Cancel</a>
        </li>
    </ul>
</div>
