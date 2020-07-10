<div class="site-mobile-menu">
  <div class="site-mobile-menu-header">
    <div class="site-mobile-menu-close mt-3">
      <span class="icon-close2 js-menu-toggle"></span>
    </div>
  </div>
  <div class="site-mobile-menu-body">
    <ul class="site-nav-wrap">
        <li class="active">
          <a href="index.html">Trang chủ</a>
        </li>
        <li class="has-children"><span class="arrow-collapse collapsed" data-toggle="collapse" data-target="#collapseItem0"></span>
          <a  rel="stylesheet" href="rooms.html">Danh sách phòng</a>
          <ul class="collapse" id="collapseItem0">
            <li><a href="rooms.html">Standard Room</a></li>
            <li><a href="rooms.html">Family Room</a></li>
            <li><a href="rooms.html">Single Room</a></li>
            <li class="has-children"><span class="arrow-collapse collapsed" data-toggle="collapse" data-target="#collapseItem1"></span>
              <a href="rooms.html">Rooms</a>
              <ul class="collapse" id="collapseItem1">
                <li><a href="rooms.html">America</a></li>
                <li><a href="rooms.html">Europe</a></li>
                <li><a href="rooms.html">Asia</a></li>
                <li><a href="rooms.html">Africa</a></li>
                
              </ul>
            </li>

          </ul>
        </li>
        <li><a href="events.html">Events</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="contact.html">Contact</a></li>
      </ul>
    </div>
</div> 
<div class="site-navbar-wrap js-site-navbar">
  <div class="container">
    <div class="site-navbar">
      <div class="py-1">
        <div class="row align-items-center">
          <div class="col-2">
            <h2 class="mb-0 site-logo"><a href="{{route('welcome')}}">Việt Nam Hotel</a></h2>
          </div>
          <div class="col-10">
            <nav class="site-navigation text-right" role="navigation">
              <div class="container">
                
                <div class="d-inline-block d-lg-none  ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu h3"></span></a></div>
                <ul class="site-menu js-clone-nav d-none d-lg-block">
                  <li class="active">
                    <a href="{{route('welcome')}}">Trang Chủ</a>
                  </li>
                  <li class="has-children">
                    <a href="rooms.html">Khách Hàng</a>
                    <ul class="dropdown arrow-top">
                      @if (Session::has('ma_khach_hang'))
                         <li><a href="{{ route('xem_tai_khoan') }}">Thông Tin Tài Khoản</a></li>
                        <li><a href="{{ route('dang_xuat') }}">đăng xuất</a></li>
                      @else
                        <li><a href="{{ route('logins') }}">Đăng Nhập</a></li>
                         <li><a href="{{ route('dang_ky') }}">Đăng Ký</a></li>
                      @endif
                    </ul>
                  <li class="has-children">
                    <a href="rooms.html">Danh Sách Phòng</a>
                    <ul class="dropdown arrow-top">
                      <li><a href="{{route('phong_doi')}}">Phòng Đôi</a></li>
                      <li><a href="rooms.html">Phòng Đơn</a></li>
                      <li class="has-children">
                        <a href="rooms.html">Phòng Theo Đơn Giá</a>
                        <ul class="dropdown">
                          <li><a href="rooms.html">100$</a></li>
                          <li><a href="rooms.html">200$</a></li>
                          <li><a href="rooms.html">250$</a></li>
                          <li><a href="rooms.html">500$</a></li>
                          
                        </ul>
                      </li>

                    </ul>
                  </li>
                  <li><a href="{{route('tin_khuyen_mai')}}">Tin Tức Khuyến Mại</a></li>
                  <li><a href="contact.html">Liên Hệ</a></li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>