<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="Sona Template">
  <meta name="keywords" content="Sona, unica, creative, html">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sona | Template</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

  <!-- Css Styles -->
  <link rel="stylesheet" href="{{ asset('assets') }}/sona/css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets') }}/sona/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets') }}/sona/css/elegant-icons.css" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets') }}/sona/css/flaticon.css" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets') }}/sona/css/owl.carousel.min.css" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets') }}/sona/css/nice-select.css" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets') }}/sona/css/jquery-ui.min.css" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets') }}/sona/css/magnific-popup.css" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets') }}/sona/css/slicknav.min.css" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets') }}/sona/css/style.css" type="text/css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .modal-header,
    .login,
    .close {
      background-color: #9bb5bb;
      color: white !important;
      text-align: center;
      font-size: 30px;
    }

    .btn-block {
      background-color: #9bb5bb;
    }

    .modal-footer {
      background-color: #f9f9f9;
    }

    .showpass {
      border: solid 1px;
      width: 30px;
      margin-left: 0px;
      margin-top: 20px;
    }

    .fa {
      padding-left: 6px;
    }
  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini" onload="now();">
  <div class="wrapper">

    {{--header--}}
    @include('booking.layout.header')
    <!-- Left side column. contains the logo and sidebar -->
    {{--Menu--}}
    {{-- @include('booking.layout.menu')  --}}
    <!-- Content Wrapper. Contains page content -->
    {{--wrapper--}}
    @yield('content')
    <!-- /.content-wrapper -->
    {{--footer--}}
    @include('booking.layout.footer')

  </div>
  <!-- ./wrapper -->
  <script src="{{ asset('assets') }}/sona/js/jquery-3.3.1.min.js"></script>
  <script src="{{ asset('assets') }}/sona/js/bootstrap.min.js"></script>
  <script src="{{ asset('assets') }}/sona/js/jquery.magnific-popup.min.js"></script>
  <script src="{{ asset('assets') }}/sona/js/jquery.nice-select.min.js"></script>
  <script src="{{ asset('assets') }}/sona/js/jquery-ui.min.js"></script>
  <script src="{{ asset('assets') }}/sona/js/jquery.slicknav.js"></script>
  <script src="{{ asset('assets') }}/sona/js/owl.carousel.min.js"></script>
  <script src="{{ asset('assets') }}/sona/js/main.js"></script>
  <script>
    function now() {
      if({{Session::get('status_login')}}!=1){
        $("#myModal").modal();
      }
    }
    $(document).ready(function() {
      $("#myBtnLg").click(function() {
        $("#myLogin").modal();
      });
      $("#myBtnRg").click(function() {
        $("#myRegister").modal();
      });
    });
  </script>
</body>

</html>