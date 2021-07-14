<!DOCTYPE html>
<html lang="en">
<head>

    @include('layouts.frontend._head')

</head>
<body>

    <!-- NAV -->
    @include('layouts.frontend._navbar')
    <!-- NAV END -->

    <main>

    @yield('content')

    </main>

    @include('layouts.frontend._footer')


    @include('layouts.frontend._script')

</body>
</html>
