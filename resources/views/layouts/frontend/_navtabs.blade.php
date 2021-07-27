<div class="col-12 mb-4">
    <ul class="nav nav-tabs navTabs">
        <li class="nav-item">
            <a class="nav-link text-success {{ request()->is('pemesanan') ? 'active' : '' }}" aria-current="page" href="{{ route('pemesanan') }}">Pemesanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-success {{ request()->is('pengiriman') ? 'active' : '' }}" href="{{ route('pengiriman') }}">Pengiriman</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-success {{ request()->is('selesai') ? 'active' : '' }}" href="{{ route('selesai') }}">Selesai</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-success {{ request()->is('cancel') ? 'active' : '' }}" href="{{ route('cancel') }}">Cancel</a>
        </li>
    </ul>
</div>
