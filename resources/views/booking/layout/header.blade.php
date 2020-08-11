    <div id="preloder">
        <div class="loader"></div>
    </div>
    <div class="offcanvas-menu-overlay"></div>
    <div class="canvas-open">
        <i class="icon_menu"></i>
    </div>
    <div class="offcanvas-menu-wrapper">
        <div class="canvas-close">
            <i class="icon_close"></i>
        </div>
        <div class="search-icon  search-switch">
            <i class="icon_search"></i>
        </div>
        <nav class="mainmenu mobile-menu">
            <ul>
                <li class="active"><a href="{{route('index')}}"> {{ __('home') }}</a></li>
                <li><a href="./rooms.html">{{ __('room') }}</a>
                    <ul class="dropdown">
                    @foreach($cate_room as $value)
                        <li><a href="{{ url('detail_cateroom/'. $value->id) }}">{{$value->name_cateroom}}</a></li>
                    @endforeach
                    </ul>
                </li>
                {{--  <li><a href="./about-us.html">{{ __('about_us') }}</a></li>  --}}
                <li><a href="{{route('blog')}}">{{ __('news') }}</a></li>
                <li><a href="{{route('contact')}}">{{ __('contact') }}</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="top-social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-tripadvisor"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
        </div>
        <ul class="top-widget">
            <li><i class="fa fa-phone"></i>{{$contact->phone}}</li>
            <li><i class="fa fa-envelope"></i>{{$contact->email}}</li>
        </ul>
    </div>
    <header class="header-section">
        <div class="top-nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="tn-left">
                            <li><i class="fa fa-phone"></i>{{$contact->phone}}</li>
                            <li><i class="fa fa-envelope"></i>{{$contact->email}}</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="tn-right">
                            <div class="top-social">
                                @if(Session::get('status_login')==0)
                                <button type="button" class="btn btn-default btn-lg" id="myBtnLg">Login</button>
                                <button type="button" class="btn btn-default btn-lg" id="myBtnRg">Register</button>
                                @elseif(Session::get('status_login')==1)
                                <a href="{{route('user.show_profile')}}">Profile </a>
                                <a href="{{route('user.logout')}}">Logout</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="myLogin" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header" style="padding:35px 50px;">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="login"><span class="glyphicon glyphicon-lock"></span> Login</h4>
                            </div>
                            <div class="modal-body" style="padding:40px 50px;">
                                <form role="form" method="POST" action="{{ route('user.login_post') }}">
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
                                    <div class="form-group">
                                        <label for="usrname"><span class="glyphicon glyphicon-user"></span> Email</label>
                                        <input type="email" placeholder="Enter email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                                        <input name="password" type="password" class="form-control" placeholder="Enter password" required autocomplete="off" />
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                        <div class="showpass" onclick="showpass()"><i class="fa fa-eye" aria-hidden="true"></i></div>
                                        <script>
                                            function showpass() {
                                                var x = document.getElementById('paswword');
                                                if (x.type === 'password') {
                                                    x.type = 'text';
                                                } else {
                                                    x.type = 'password';
                                                }
                                            }
                                        </script>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                <p>Not a member? <a href="#">Sign Up</a></p>
                                <p>Forgot <a href="{{route('password_user')}}">Password?</a></p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal fade" id="myRegister" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header" style="padding:35px 50px;">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="login"><span class="glyphicon glyphicon-lock"></span> Register</h4>
                            </div>
                            <div class="modal-body" style="padding:40px 50px;">
                                <form role="form" method="POST" action="{{ route('user.register') }}">
                                    @csrf
                                    @if ( Session::has('errorRg') )
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <strong>{{ Session::get('errorRg') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
                                        <input id="name" type="text" placeholder="Enter name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                        @if ($errors->has('emanameil'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="usrname"><span class="glyphicon glyphicon-user"></span> Email</label>
                                        <input id="email" type="email" placeholder="Enter email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="usrname"><span class="glyphicon glyphicon-user"></span> Phone</label>
                                        <input id="phone" type="tel" placeholder="Enter phonenumber" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>
                                        @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="usrname"><span class="glyphicon glyphicon-user"></span> Identity Card</label>
                                        <input id="identity_card" type="text" placeholder="Enter identity card" class="form-control{{ $errors->has('identity_card') ? ' is-invalid' : '' }}" name="identity_card" value="{{ old('identity_card') }}" required autofocus>
                                        @if ($errors->has('identity_card'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('identity_card') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                                        <input name="password" id="paswword" type="password" class="form-control" placeholder="Enter password" required autocomplete="off" />
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                        <div class="showpass" onclick="showpass()"><i class="fa fa-eye" aria-hidden="true"></i></div>
                                        <script>
                                            function showpass() {
                                                var x = document.getElementById('paswword');
                                                if (x.type === 'password') {
                                                    x.type = 'text';
                                                } else {
                                                    x.type = 'password';
                                                }
                                            }
                                        </script>
                                    </div>
                                    <div class="form-group">
                                        <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password confirm</label>
                                        <input name="password_confirm" id="password_confirm" type="password" class="form-control" placeholder="Enter password" required autocomplete="off" />
                                        @if ($errors->has('password_confirm'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirm') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" value="" checked>Remember me</label>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                <p>Not a member? <a href="#">Sign Up</a></p>
                                <p>Forgot <a href="#">Password?</a></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="menu-item">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="{{route('index')}}">
                                <img src="assets/sona/img/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="nav-menu">
                            <nav class="mainmenu">
                                <ul>
                                    <li class="active"><a href="{{route('index')}}"> {{ __('home') }}</a></li>
                                    <li><a href="{{route('category_room')}}"> {{ __('room') }}</a>
                                        <ul class="dropdown">
                                             @foreach($cate_room as $value)
                        <li><a href="{{ url('detail_cateroom/'. $value->id) }}">{{$value->name}}</a></li>
                    @endforeach
                                        </ul>
                                    </li>
                                    {{--  <li><a href="{{route('about_us')}}">{{ __('about_us') }}</a></li>  --}}
                                    <li><a href="{{route('blog')}}">{{ __('news') }}</a></li>
                                    <li><a href="{{route('contact')}}">{{ __('contact') }}</a></li>
                                </ul>
                            </nav>
                            <div class="nav-right search-switch">
                                {{--  <i class="icon_search"></i>  --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>