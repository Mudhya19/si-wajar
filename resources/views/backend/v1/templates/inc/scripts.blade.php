        <!-- CoreUI and necessary plugins-->
        <script src="{{ url('templates/backend') }}/node_modules/@coreui/coreui/dist/js/coreui.bundle.min.js"></script>
        <script src="{{ url('templates/backend') }}/node_modules/simplebar/dist/simplebar.min.js"></script>
        <script>
        const header = document.querySelector('header.header');

        document.addEventListener('scroll', () => {
            if (header) {
            header.classList.toggle('shadow-sm', document.documentElement.scrollTop > 0);
            }
        });

        </script>
        <!-- Plugins and scripts required by this view-->
        <script src="{{ url('templates/backend') }}/node_modules/chart.js/dist/chart.umd.js"></script>
        <script src="{{ url('templates/backend') }}/node_modules/@coreui/chartjs/dist/js/coreui-chartjs.js"></script>
        <script src="{{ url('templates/backend') }}/node_modules/@coreui/utils/dist/umd/index.js"></script>
        <script src="{{ url('templates/backend') }}/js/main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script> --}}
        <script>
        </script>
    </body>
</html>
