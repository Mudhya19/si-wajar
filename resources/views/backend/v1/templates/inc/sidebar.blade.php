<div class="sidebar sidebar-dark sidebar-fixed border-end d-flex flex-column" id="sidebar">
    <div class="sidebar-header border-bottom">
        <div class="sidebar-brand">
            <svg class="sidebar-brand-full" width="88" height="32" alt="CoreUI Logo">
                <use xlink:href="{{ url('templates/backend/src') }}/assets/brand/coreui.svg#full"></use>
            </svg>
            <svg class="sidebar-brand-narrow" width="32" height="32" alt="CoreUI Logo">
                <use xlink:href="{{ url('templates/backend/src') }}/assets/brand/coreui.svg#signet"></use>
            </svg>
        </div>
        <button class="btn-close d-lg-none" type="button" data-coreui-dismiss="offcanvas" data-coreui-theme="dark"
            aria-label="Close"
            onclick="coreui.Sidebar.getInstance(document.querySelector(&quot;#sidebar&quot;)).toggle()"></button>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
        <li class="nav-item"><a class="nav-link" href="index.html">
                <svg class="nav-icon">
                    <use xlink:href="{{ url('templates/backend')  }}/node_modules/@coreui/icons/sprites/free.svg#cil-speedometer"></use>
                </svg> Dashboard<span class="badge badge-sm bg-info ms-auto"></span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <li
            class="nav-item {{ in_array(Route::currentRouteName(), ['menu.index', 'menu.create', 'menu.edit']) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('menu.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ url('templates/backend')  }}/node_modules/@coreui/icons/sprites/free.svg#cil-clipboard"></use>
                </svg>Menu<span class="badge badge-sm bg-info ms-auto"></span>
            </a>
        </li>
        <li
            class="nav-item {{ in_array(Route::currentRouteName(), ['masakan.index', 'masakan.create', 'masakan.edit']) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('masakan.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ url('templates/backend')  }}/node_modules/@coreui/icons/sprites/free.svg#cil-columns"></use>
                </svg>Harga Masakan<span class="badge badge-sm bg-info ms-auto"></span>
            </a>
        </li>
        </li>
        <li
            class="nav-item {{ in_array(Route::currentRouteName(), ['transaksi.index', 'transaksi.create', 'transaksi.edit']) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('transaksi.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ url('templates/backend') }}/node_modules/@coreui/icons/sprites/free.svg#cil-chart-line"></use>
                </svg>Transaksi<span class="badge badge-sm bg-info ms-auto"></span>
            </a>
        </li>
    </ul>
    <!-- Konten Sidebar -->
    <div class="sidebar-content flex-grow-1">
        <!-- Tambahkan konten sidebar Anda di sini -->
    </div>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer border-top mt-auto">
        <button class="sidebar-toggler w-100" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
</div>
