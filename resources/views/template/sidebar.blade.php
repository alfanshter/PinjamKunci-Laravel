<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Pinjam Kunci </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider" />

    @if(auth()->user()->role == 0)
    <li class="nav-item {{ request()->is('rfid') ? 'active' : '' }}">
        <a class="nav-link" href="/rfid">
            <i class="fas fa-fw fa-id-card"></i>
            <span>RFID</span>
        </a>
    </li>

    <li class="nav-item {{ request()->is('fasilitas') ? 'active' : '' }}">
        <a class="nav-link" href="/fasilitas">
            <i class="fas fa-fw fa-building"></i>
            <span>Fasilitas</span>
        </a>
    </li>
    <li class="nav-item {{ request()->is('booking') ? 'active' : '' }}">
        <a class="nav-link" href="/booking">
            <i class="fas fa-fw fa-calendar-check"></i>
            <span>Booking</span>
        </a>
    </li>

    <li class="nav-item {{ request()->is('peminjaman') ? 'active' : '' }}">
        <a class="nav-link" href="/peminjaman">
            <i class="fas fa-fw fa-book"></i>
            <span>Log Peminjaman</span>
        </a>
    </li>

    <li class="nav-item {{ request()->is('users') ? 'active' : '' }}">
        <a class="nav-link" href="/mahasiswa">
            <i class="fas fa-fw fa-user-graduate"></i>
            <span>Mahasiswa</span>
        </a>
    </li>
    <li class="nav-item {{ request()->is('dosen') ? 'active' : '' }}">
        <a class="nav-link" href="/dosen">
            <i class="fas fa-fw fa-chalkboard-teacher"></i>
            <span>Dosen</span>
        </a>
    </li>

    @elseif(auth()->user()->role == 1)
    <li class="nav-item {{ request()->is('ruangan') ? 'active' : '' }}">
        <a class="nav-link" href="/ruangan">
            <i class="fas fa-fw fa-door-open"></i>
            <span>Ruangan</span>
        </a>
    </li>
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
