<!DOCTYPE html>
<html>

    @include('components.backend.linkcsslogin-backend')

    <body class="bg-default">
        <!-- Main content -->
        <div class="main-content">
            @yield('content')
            @include('sweetalert::alert')
            {{-- @include('components.backend.footer-backend') --}}
            @include('components.backend.scriptlogin-backend')
        </div>

    </body>

</html>
