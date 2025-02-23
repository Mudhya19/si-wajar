<script>
    const header = document.querySelector('header.header');

    document.addEventListener('scroll', () => {
        if (header) {
            header.classList.toggle('shadow-sm', document.documentElement.scrollTop > 0);
        }
    });

    document.getElementById('togglePassword').addEventListener('click', function() {
        const password = document.getElementById('password');
        const icon = this.querySelector('i');
        const text = this.querySelector('span');

        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
            text.textContent = 'Sembunyikan';
        } else {
            password.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
            text.textContent = 'Tampilkan';
        }
    });
</script>
{{-- @push('script') --}}
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const hargaSatuan = document.getElementById('harga_satuan');
        const jumlahSatuan = document.getElementById('jumlah_satuan');
        const totalHarga = document.getElementById('total_harga');

        function calculateTotal() {
            const harga = parseInt(hargaSatuan.value) || 0000;
            const jumlah = parseInt(jumlahSatuan.value) || 0;
            totalHarga.value = harga * jumlah;
        }

        // Hitung saat input berubah
        hargaSatuan.addEventListener('input', calculateTotal);
        jumlahSatuan.addEventListener('input', calculateTotal);

        // Hitung saat pertama kali load (untuk edit)
        calculateTotal();
    });
</script> --}}
{{-- @endpush --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hargaSatuan = document.getElementById('harga_satuan');
        const jumlahSatuan = document.getElementById('jumlah_satuan');
        const totalHarga = document.getElementById('total_harga');

        // Format number dengan titik sebagai pemisah ribuan
        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Parse number dari format string dengan titik
        function parseNumber(str) {
            return parseInt(str.replace(/\./g, '')) || 0;
        }

        function calculateTotal() {
            const harga = parseNumber(hargaSatuan.value);
            const jumlah = parseInt(jumlahSatuan.value) || 0;
            const total = harga * jumlah;

            totalHarga.value = formatNumber(total);
        }

        // Format harga satuan saat input
        hargaSatuan.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\./g, '');
            if (!isNaN(value)) {
                e.target.value = formatNumber(value);
            }
        });

        // Format harga satuan saat keluar dari field
        hargaSatuan.addEventListener('blur', function(e) {
            let value = parseNumber(e.target.value);
            e.target.value = formatNumber(value);
        });

        // Hitung saat input berubah
        hargaSatuan.addEventListener('input', calculateTotal);
        jumlahSatuan.addEventListener('input', calculateTotal);

        // Format nilai awal jika ada
        if (hargaSatuan.value) {
            hargaSatuan.value = formatNumber(parseNumber(hargaSatuan.value));
        }
        if (totalHarga.value) {
            totalHarga.value = formatNumber(parseNumber(totalHarga.value));
        }

        calculateTotal();
    });
</script>
<!-- CoreUI and necessary plugins-->
<script src="{{ url('templates/backend') }}/node_modules/@coreui/coreui/dist/js/coreui.bundle.min.js"></script>
<script src="{{ url('templates/backend') }}/node_modules/simplebar/dist/simplebar.min.js"></script>
<!-- Plugins and scripts required by this view-->
<script src="{{ url('templates/backend') }}/node_modules/chart.js/dist/chart.umd.js"></script>
<script src="{{ url('templates/backend') }}/node_modules/@coreui/chartjs/dist/js/coreui-chartjs.js"></script>
<script src="{{ url('templates/backend') }}/node_modules/@coreui/utils/dist/umd/index.js"></script>
<script src="{{ url('templates/backend') }}/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script> --}}
<script></script>
</body>

</html>
