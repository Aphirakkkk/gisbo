<!DOCTYPE html>
<html>
    @include('components.backend.linkcss-backend')

    <body>
        @include('components.backend.sidenav-backend')
        <!-- Main content -->
        <div class="main-content" id="panel">
            <!-- Header -->
            <!-- Header -->
            @include('components.backend.headersub-backend')
            <!-- Page content -->
            <div class="container-fluid mt--6">
                @yield('content')
                <!-- Footer -->
                {{-- @include('components.backend.footer-backend') --}}
            </div>
        </div>
        @include('components.backend.script-backend')
    </body>
</html>
