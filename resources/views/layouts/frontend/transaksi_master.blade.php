<!DOCTYPE html>
<html lang="en">
<head>

    @include('layouts.frontend._head')

</head>
<body>

    <!-- NAV -->
    @include('layouts.frontend._navbar')
    <!-- NAV END -->

    <div class="row g-0 mt-5 pt-3">

        <!-- Sidebar -->
        @include('layouts.frontend._sidebar')

        <div class="col-12 transaksi-main col-md-10 pb">
            <div class="container">
                <main class="card-3 pb-3">

                    <!-- NAV Tab -->
                    @include('layouts.frontend._navtabs')

                    <!-- Data Pemesanan -->

                    {{-- <div class="row mx-3 mt-4 text-success">
                        <h3>Pemesanan</h3>
                    </div> --}}

                    <div class="row g-0 mx-4 mt-4">
                        <div class="col">
                            <input class="form-control me-2" type="search" placeholder="Cari..." aria-label="Search">
                        </div>
                        <div class="col-2 col-md-1">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </div>
                    </div>

                    {{-- CONTENT --}}

                    @yield('content')


                </main>
            </div>
        </div>
    </div>


    @include('layouts.frontend._script')

</body>
</html>
