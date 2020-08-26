<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('') }}/admins/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <h4>{{Auth::guard('admin')->user()->name}}</h4>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="{{route('view_all_admin')}}">
                    <i class="fa fa-user"></i> <span>Admin</span>
                </a>
            </li>
            <li>
                <a href="{{route('view_all_user')}}">
                    <i class="fa fa-users"></i> <span>User</span>
                </a>
            </li>
            <li>
                <a href="{{route('view_all_loai_phong')}}">
                    <i class="fa fa-building"></i> <span>Loại phòng</span>
                </a>
            </li>
            <li>
                <a href="{{route('view_all_phong')}}">
                    <i class="fa fa-address-book"></i> <span>Phòng</span>
                </a>
            </li>
            <li>
                <a href="{{route('view_dat_phong',0)}}">
                    <i class="fa fa-book"></i> <span>Đặt phòng</span>
                </a>
            </li>
            <li>
                <a href="{{route('chua_nhan_phong')}}">
                    <i class="fa fa-calculator"></i> <span>Hóa đơn</span>
                </a>
            </li>
            <li>
                <a href="{{route('view_all_service')}}">
                    <i class="fa fa-umbrella"></i> <span>Dịch vụ</span>
                </a>
            </li>
            <li>
                <a href="{{route('view_all_cate_blog')}}">
                    <i class="fa fa-newspaper-o"></i> <span>Loại tin tức</span>
                </a>
            </li>
            <li>
                <a href="{{route('view_all_blog')}}">
                    <i class="fa fa-file-text-o"></i> <span>Tin tức</span>
                </a>
            </li>
            <li>
                <a href="{{Route('contact.list')}}">
                    <i class="fa fa-tty"></i> <span>Liên hệ</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bar-chart-o"></i> <span>Thống kê</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('view_month')}}"><i class="fa fa-plus"></i>Theo tháng</a></li>
                    <li><a href="{{route('view_year')}}"><i class="fa fa-plus"></i> Theo năm </a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>