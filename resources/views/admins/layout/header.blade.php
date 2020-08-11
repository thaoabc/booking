<header class="main-header">
    <!-- Logo -->
    <a href="{{route('view_all_admin')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>SO</b>NA</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>SONA</b>HOTEL</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('') }}/admins/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{Auth::guard('admin')->user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ asset('') }}/admins/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                            <p>
                                {{Auth::guard('admin')->user()->name}} - Web Developer
                                <small>
                                    @if(Auth::guard('admin')->user()->level==1)
                                    Quản trị viên
                                    @else
                                    Nhân viên
                                    @endif
                                </small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{route('admin.logout')}}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>