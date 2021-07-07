<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.backend._head')

</head>
<body>

    @include('layouts.backend._navbar')

    <div class="row g-0">

        @include('layouts.backend._sidebar')

        @yield('content')

    </div>

    @include('layouts.backend._script')

</body>
</html>
