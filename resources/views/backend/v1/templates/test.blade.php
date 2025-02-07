<!DOCTYPE html>
<html lang="en">

@include('backend.v1.templates.test.header')

<body id="page-top">
    <div id="wrapper">
        <div>
            <div id="content-wrapper" class="d-flex flex-column">
                @include('backend.v1.templates.test.sidebar')
                <!-- Sidebar -->
                <div id="content">
                    <!-- TopBar -->
                    @include('backend.v1.templates.test.navbar')
                    <!-- Topbar -->
                    <div>
                        <div class="container-fluid" id="container-wrapper">
                            <!-- Container Fluid-->
                            @yield('content')
                            <!---Container Fluid-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Scroll to top -->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        @include('backend.v1.templates.test.footer')
        {{-- footer --}}
        @include('backend.v1.templates.test.scripts')
</body>

</html>
