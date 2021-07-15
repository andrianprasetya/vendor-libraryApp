<!-- Brand Logo -->
<a href="{{env('APP_URL')}}" class="brand-link">
    <img src="{{asset('/dashboard/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle"
         style="opacity: .8">
    <span class="brand-text font-weight-light">PERPUSTAKAAN</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
{{--<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
    </div>
</div>--}}

<!-- SidebarSearch Form -->
{{--<div class="form-inline">
    <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
               aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
            </button>
        </div>
    </div>
</div>--}}

<!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-header">MENU</li>
            <li class="nav-item menu-open">
                <a href="{{ route($routes['web']. 'dashboard.index')}}" class="nav-link active">
                    <i class="fas fa-home nav-icon"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon ion ion-person"></i>
                    <p>
                        Anggota
                        <i class="fas fa-angle-left right"></i>
                        {{--<span class="badge badge-info right">6</span>--}}
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route($routes['web']. 'member.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Daftar Anggota</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-bars"></i>
                    <p>
                        Sirkulasi Menu
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{!! route($routes['web'].'sirkulasi.peminjaman.create') !!}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Mulai Peminjaman</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{!! route($routes['web'].'sirkulasi.pengembalian.index') !!}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pengembalian</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{!! route($routes['web'].'sirkulasi.perpanjangan.index') !!}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Perpanjangan</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-file-alt"></i>
                    <p>
                        Laporan
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>????</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>OPAC</p>
                </a>
            </li>
            <li class="nav-item bg-danger">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                        Keluar
                    </p>
                </a>
            </li>
            <li class="nav-header">INFORMASI TAMBAHAN</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-home nav-icon"></i>
                    <p>
                        Perpustakaan
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-exclamation"></i>
                    <p>
                        Panduan
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
