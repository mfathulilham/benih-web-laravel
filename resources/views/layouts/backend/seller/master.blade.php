<!DOCTYPE html>
<html lang="en">
<head>

    @include('layouts.backend.seller._head')

</head>
<body>

    <!-- NAV -->
    @include('layouts.backend.seller._navbar')

    <!-- CONTENT -->
    <div class="row g-0">

        <!-- SIDEBAR -->
        @include('layouts.backend.seller._sidebar')

        </div>

        <!-- CONTENT -->
        @yield('content')


    </div>


    @include('layouts.backend.seller._script')

</body>
</html>
