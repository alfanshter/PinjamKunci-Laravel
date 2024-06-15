     <!-- Sidebar -->
     <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
         <!-- Sidebar - Brand -->
         <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
             <div class="sidebar-brand-icon rotate-n-15">
                 <i class="fas fa-laugh-wink"></i>
             </div>
             <div class="sidebar-brand-text mx-3">Project </sup></div>
         </a>

         <!-- Divider -->
         <hr class="sidebar-divider my-0" />

         <!-- Nav Item - Dashboard -->
         <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }} ">
             <a class="nav-link" href="/dashboard">
                 <i class="fas fa-fw fa-tachometer-alt"></i>
                 <span>Dashboard</span></a>
         </li>
         <!-- Divider -->
         <hr class="sidebar-divider" />

         @if(auth()->user()->role == 0)
         <li class="nav-item {{ request()->is('rfid') ? 'active' : '' }}">
             <a class="nav-link" href="/rfid">
                 <i class="fas fa-fw fa-tachometer-alt"></i>
                 <span>RFID</span></a>
         </li>

         <li class="nav-item {{ request()->is('ruangan') ? 'active' : '' }}">
             <a class="nav-link" href="/ruangan">
                 <i class="fas fa-fw fa-tachometer-alt"></i>
                 <span>Ruangan</span></a>
         </li>
         <li class="nav-item {{ request()->is('fasilitas') ? 'active' : '' }}">
             <a class="nav-link" href="/fasilitas">
                 <i class="fas fa-fw fa-tachometer-alt"></i>
                 <span>Fasilitas</span></a>
         </li>
         <li class="nav-item  {{ request()->is('booking') ? 'active' : '' }}">
             <a class="nav-link" href="/booking">
                 <i class="fas fa-fw fa-tachometer-alt"></i>
                 <span>Booking</span></a>
         </li>
         <li class="nav-item  {{ request()->is('users') ? 'active' : '' }}">
             <a class="nav-link" href="/mahasiswa">
                 <i class="fas fa-fw fa-tachometer-alt"></i>
                 <span>Mahasiswa</span></a>
         </li>
         <li class="nav-item  {{ request()->is('dosen') ? 'active' : '' }}">
             <a class="nav-link" href="/dosen">
                 <i class="fas fa-fw fa-tachometer-alt"></i>
                 <span>Dosen</span></a>
         </li>


         @elseif(auth()->user()->role == 1)
         <li class="nav-item {{ request()->is('ruangan') ? 'active' : '' }}">
             <a class="nav-link" href="/ruangan">
                 <i class="fas fa-fw fa-tachometer-alt"></i>
                 <span>Ruangan</span></a>
         </li>
         @endif

         <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Menu</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Menu:</h6>
                    <a class="collapse-item" href="utilities-color.html">Fasilitas</a>
                    <a class="collapse-item" href="utilities-border.html">Ruangan</a>
                    <a class="collapse-item" href="utilities-animation.html">Peminjaman</a>
                    <a class="collapse-item" href="utilities-other.html">Booking</a>
                </div>
                </div>
            </li> -->



         <!-- Sidebar Toggler (Sidebar) -->
         <div class="text-center d-none d-md-inline">
             <button class="rounded-circle border-0" id="sidebarToggle"></button>
         </div>
     </ul>
     <!-- End of Sidebar -->