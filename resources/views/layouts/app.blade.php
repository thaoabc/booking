<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/toastr.css') }}">

    <style>
        /* these styles will animate bootstrap alerts. */
        .alert{
            z-index: 99;
            top: 60px;
            right:18px;
            min-width:30%;
            position: fixed;
            animation: slide 0.5s forwards;
        }
        @keyframes slide {
            100% { top: 30px; }
        }
        @media screen and (max-width: 668px) {
            .alert{ /* center the alert on small screens */
                left: 10px;
                right: 10px;
            }
        }
    </style>

    <title>{{config('app.name')}}</title>
</head>
<body>

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'NCD') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{--<!-- Left Side Of Navbar -->--}}
                    {{--<ul class="navbar-nav mr-auto">--}}

                    {{--</ul>--}}

                    <!-- Right Side Of Navbar -->

                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <script src="{{asset('js/app.js')}}"></script>

        <script src="{{ asset('assets/admin/dist/js/toastr.min.js') }}"></script>
        @if(session('thongbao'))
        <script type="text/javascript">
            toastr.success('{{ session('thongbao') }}', 'Thông báo', {timeOut: 3000});
            toastr.options.progressBar = true;
        </script>
        @endif
        @if(session('error'))
            <script type="text/javascript">
                toastr.error('{{ session('error') }}', 'Thông báo', {timeOut: 3000});
            </script>
        @endif
</body>
</html>
