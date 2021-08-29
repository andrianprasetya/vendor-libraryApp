<!-- Brand Logo -->
<a href="{{env('APP_URL')}}" class="brand-link">
    <img src="{{asset('/dashboard/dist/img/logo.jpeg')}}" alt="AdminLTE Logo" class="brand-image img-circle"
         style="opacity: .8">
    <span class="brand-text font-weight-light">PERPUSTAKAAN</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header">MENU</li>
            <li class="nav-item">
                <a href="{{ route($routes['web']. 'dashboard.index')}}" class="nav-link {{$slug == 'web/dashboard' ? 'active':''}}">
                    <i class="fas fa-home nav-icon"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            {!! (new \App\Libraries\SidebarLibrary)->generate($slug) !!}
            <li class="nav-header">INFORMASI TAMBAHAN</li>
            <li class="nav-item">
                <a href="{{route('web::about')}}" class="nav-link">
                    <i class="fas fa-home nav-icon"></i>
                    <p>
                        Perpustakaan
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
