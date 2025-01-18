<!DOCTYPE html>
<html lang="en">

@include('backend.v1.templates.inc.header')

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        @include('backend.v1.templates.inc.sidebar')
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                @include('backend.v1.templates.inc.navbar')
                <!-- Topbar -->

                <div class="container-fluid" id="container-wrapper">
                    <!-- Container Fluid-->
                    @yield('content')
                    <!---Container Fluid-->
                </div>
                @include('backend.v1.templates.inc.footer')
            {{-- footer --}}
            </div>
        </div>
    </div>
    @include('backend.v1.templates.inc.scripts')
    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

</body>

</html>
