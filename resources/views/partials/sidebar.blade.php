<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">VIOSCAKE</div>
    </a>

    <hr class="sidebar-divider my-0" />

    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- <hr class="sidebar-divider" /> -->

    <li class="nav-item {{ request()->routeIs('katalog') ? 'active' : '' }}">
        <a href="{{ route('katalog') }}" class="nav-link">
            <i class="fas fa-photo-video"></i>
            <span>Katalog</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('pesanan') ? 'active' : '' }}">
        <a href="{{ route('pesanan') }}" class="nav-link">
            <i class="fas fa-shopping-basket"></i>
            <span>Pesanan</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('laporan') ? 'active' : '' }}">
        <a href="{{ route('laporan') }}" class="nav-link">
            <i class="fas fa-chart-bar"></i>
            <span>Laporan</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block" />

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>