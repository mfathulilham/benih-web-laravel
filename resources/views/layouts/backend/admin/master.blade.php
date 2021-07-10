<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.backend.admin._head')

</head>
<body>

    @include('layouts.backend.admin._navbar')

    <div class="row g-0">

        @include('layouts.backend.admin._sidebar')

        @yield('content')

    </div>

    @include('layouts.backend.admin._script')

</body>
</html>
