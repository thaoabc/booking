<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('') }}/admins/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> {{Auth::user()->name}}</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-address-book"></i> <span>Admin</span>
                    <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('view_all_admin')}}"><i class="fa fa-list"></i> Danh sách admin</a></li>
                    <li><a href="{{route('view_insert_admin')}}"><i class="fa fa-plus"></i> Thêm admin </a></li>
                </ul>
            </li>
             <li>
                <a href="{{route('view_all_user')}}">
                    <i class="fa fa-address-book"></i> <span>User</span>
                    <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
                </span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-address-book"></i> <span>Loại phòng</span>
                    <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('view_all_loai_phong')}}"><i class="fa fa-list"></i> Danh sách loại phòng</a></li>
                    <li><a href="{{route('view_insert_loai_phong')}}"><i class="fa fa-plus"></i> Thêm loại phòng </a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-address-book"></i> <span>Phòng</span>
                    <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('view_all_phong')}}"><i class="fa fa-list"></i> Danh sách phòng</a></li>
                    <li><a href="{{route('view_insert_phong')}}"><i class="fa fa-plus"></i> Thêm phòng </a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-address-book"></i> <span>Đặt phòng</span>
                    <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('view_dat_phong',0)}}"><i class="fa fa-list"></i> Đặt phòng</a></li>
                    
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-address-book"></i> <span>Hóa đơn</span>
                    <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('chua_nhan_phong')}}"><i class="fa fa-list"></i>Hóa đơn</a></li>
                    
                </ul>
            </li>
            {{--  <li class="treeview">
                <a href="#">
                    <i class="fa fa-address-book"></i> <span>Thống kê</span>
                    <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('view_month')}}"><i class="fa fa-list"></i>Thống kê</a></li>
                    <li><a href="{{route('view_year')}}"><i class="fa fa-plus"></i> Theo năm </a></li>
                </ul>
            </li>  --}}
            
            <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>