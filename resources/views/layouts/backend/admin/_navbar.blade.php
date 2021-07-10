<!-- NAV -->
<nav class="navbar navbar-expand-lg navbar-light bg-success text-light">

    <h3>
        <i class="fas fa-seedling"></i>
        <a class="navbar-brand text-light" href="ikbHome.html">BenihKu Admin</a>
    </h3>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">

            <li class="nav-item dropdown ms-3">
                <a href="#" class="nav-link d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=d5d657&color=fff" alt="" width="32" height="32" class="rounded-circle me-2">


                <!-- <strong>Logout</strong> -->
                </a>
                <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="userProfile.html">Akun Saya</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                </ul>
            </li>
        </ul>
    </div>

</nav>
