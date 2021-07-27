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

        <div class="col-12 transaksi-main col-md-10 bg-light pb-4">
            <div class="container">
                <div class="card-3 pb-3 bg-white">

                    {{-- CONTENT --}}

                    @yield('content')


                </div>
            </div>
        </div>
    </div>


    @include('layouts.frontend._script')

</body>
</html>
