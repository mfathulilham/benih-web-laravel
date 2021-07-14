<!-- SIDEBAR -->


<div class="sidebar col-12 col-md-3 col-lg-2 bg-light">

    <div class="d-flex flex-column p-3 bg-light">

        <ul class="nav nav-pills flex-column mb-auto">
            <li class="text-center">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=d5d657&color=fff" alt="img-profile" class="rounded-circle mb-2">
                <h6>{{ Auth::user()->name}}</h6>
            </li>
            <li>
                <a href="{{ route('dashboard') }}" class="nav-link link-dark {{ request()->is('dashboard') ? 'bg-success active' : '' }}">
                    <i class="fas fa-home me-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('customer') }}" class="nav-link link-dark {{ request()->is('customer') ? 'bg-success active' : '' }} {{ request()->is('customer/*') ? 'bg-success active' : '' }}">
                    <i class="fas fa-users me-2"></i>
                    Customers
                </a>
            </li>
            <li>
                <a href="{{ route('seller') }}" class="nav-link link-dark {{ request()->is('seller') ? 'bg-success active' : '' }} {{ request()->is('seller/*') ? 'bg-success active' : '' }}">
                    <i class="fas fa-users me-2"></i>
                    Ikb
                </a>
            </li>
            <li>
                <a href="{{ route('order') }}" class="nav-link link-dark {{ request()->is('order') ? 'bg-success active' : '' }}">
                    <i class="far fa-handshake me-2"></i>
                    Order
                </a>
            </li>
        </ul>
    </div>

</div>

<!-- SIDEBAR END -->
