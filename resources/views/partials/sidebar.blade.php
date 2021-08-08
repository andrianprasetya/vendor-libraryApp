<!-- Brand Logo -->
<a href="{{env('APP_URL')}}" class="brand-link">
    <img src="{{asset('/dashboard/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle"
         style="opacity: .8">
    <span class="brand-text font-weight-light">PERPUSTAKAAN</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
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
            {!! (new \App\Libraries\SidebarLibrary)->generate($slug) !!}

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
