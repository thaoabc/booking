{{--@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.login_post') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!--
	Author: W3layouts
	Author URL: http://w3layouts.com
	License: Creative Commons Attribution 3.0 Unported
	License URL: http://creativecommons.org/licenses/by/3.0/
-->--}}
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Switch Login Form Flat Responsive Widget Template :: w3layouts</title>
    <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Switch Login Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta-Tags -->
    <!-- Index-Page-CSS -->
    <link rel="stylesheet" href="{{ asset('admins/login') }}/css/style.css" type="text/css" media="all">
    <!-- //Custom-Stylesheet-Links -->
    <!--fonts -->
    <link href="//fonts.googleapis.com/css?family=Mukta+Mahee:200,300,400,500,600,700,800" rel="stylesheet">
    <!-- //fonts -->
    <!-- Font-Awesome-File-Links -->
    <link rel="stylesheet" href="{{ asset('admins/login') }}/css/font-awesome.css" type="text/css" media="all">
</head>

<body>
<h1 class="title-agile text-center">Login Admin</h1>
<div class="content-w3ls">
    <div class="content-top-agile">
        <h2>sign in</h2>
    </div>
    <div class="content-bottom">
        <form method="POST" action="{{ url('admin/login') }}">
            @csrf
            @if ( Session::has('error') )
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <strong>{{ Session::get('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
            @endif
            <div class="field-group">
                <span class="fa fa-user" aria-hidden="true"></span>
                <div class="wthree-field">
                    <input name="email" id="username" type="email" placeholder="Email*" required autocomplete="off" />
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="field-group pass">
                <span class="fa fa-lock" aria-hidden="true"></span>
                <div class="wthree-field">
                    <input name="password" id="paswword" type="password" placeholder="Password*" required autocomplete="off" />
                </div>

                <div class="showpass"><i class="fa fa-eye" aria-hidden="true" onclick="showpass()"></i></div>
                <script>
                    function showpass() {
                        var x= document.getElementById('paswword');
                        if(x.type=== 'password'){
                            x.type='text';
                        }
                        else{
                            x.type='password';
                        }
                    }
                </script>
            </div>
            <ul class="list-login">
                <li class="switch-agileits">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </li>
                <li>
                    <a href="{{url('admin/password/reset')}}" class="text-right" style="color: white">forgot password?</a>
                </li>
                <li class="clearfix"></li>
            </ul>
            <div class="wthree-field">
                <input id="saveForm" name="saveForm" type="submit" value="sign in"/>
            </div>
        </form>
    </div>
</div>
<div class="copyright text-center">
    <p>© 2018 Switch Login Form. All rights reserved | Design by
        <a href="http://w3layouts.com">W3layouts</a>
    </p>
</div>
</body>
<!-- //Body -->

</html>
