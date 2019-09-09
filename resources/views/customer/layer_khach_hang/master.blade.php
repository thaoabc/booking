<html lang="en"><head>
    <title>Suite — Colorlib Website Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Work+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('suites/css/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{asset('suites/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('suites/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('suites/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('suites/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('suites/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('suites/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('suites/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/mediaelementplayer.min.css">
    
  </head>
  <body data-aos-easing="slide" data-aos-duration="800" data-aos-delay="0">
  
  <div class="site-wrap">

    @include('customer.layer_khach_hang.menu')

    <div class="site-section bg-light">
      <div class="container">
        @yield('content')
      </div>
    </div>

    @include('customer.layer_khach_hang.footer')
    
  </div>

  <script src="{{asset('suites/js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{asset('suites/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{asset('suites/js/jquery-ui.js')}}"></script>
  <script src="{{asset('suites/js/popper.min.js')}}"></script>
  <script src="{{asset('suites/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('suites/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('suites/js/jquery.stellar.min.js')}}"></script>
  <script src="{{asset('suites/js/jquery.countdown.min.js')}}"></script>
  <script src="{{asset('suites/js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{asset('suites/js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{asset('suites/js/aos.js')}}"></script>

  
  <script src="{{asset('suites/js/mediaelement-and-player.min.js')}}"></script>

  <script src="{{asset('suites/js/main.js')}}"></script>
    

  
</body>
</html>