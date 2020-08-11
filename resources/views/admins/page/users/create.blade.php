@extends('admins.layout.master-layout')
@section('title')
Thêm users
@endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <style>
            .input {
                background: none;
                border: none;
            }
        </style>
        <section class="content-header">

            {{-- @if($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{ $error }}
    </div>
    @endforeach
    @endif --}}

    <h1>
        Tạo tài khoản khách hàng
    </h1>
    @if ( Session::has('error') )
    <div class="alert alert-danger alert-dismissible" role="alert">
        <strong>{{ Session::get('error') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
    </div>
    @endif
    <ol class="breadcrumb">
        <li><a href="{{ Route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ Route('view_all_user') }}"><i class="fa  fa-users"></i> Danh sách khách hàng</a></li>
        <li class="active">Đăng ký tài khoản khách hàng</li>
    </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a style="text-align: right;" href="{{route('view_all_user')}}" class="btn btn-primary">Danh sách</a>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <form action="{{Route('process_insert_user')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <p>Tên</p>
                                    <input name="name" class="form-control" type="text" placeholder="Tên users" value="{{ old('name') }}">
                                    {{-- @if ($errors->has('name'))  --}}
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    {{-- @endif  --}}
                                </div>
                                <div class="form-group">
                                    <lable for="email">Email:</lable>
                                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                                    {{-- @if ($errors->has('email'))  --}}
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    {{-- @endif  --}}
                                </div>
                                <div class="form-group">
                                    <lable for="phone">Phone:</lable>
                                    <input type="text" name="phone" class="form-control" placeholder="Số điện thoại" value="{{ old('phone') }}">
                                    {{-- @if ($errors->has('phone'))  --}}
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    {{-- @endif  --}}
                                </div>
                                <div class="form-group">
                                    <lable for="phone">Chứng minh thư:</lable>
                                    <input type="text" name="identity_card" class="form-control" placeholder="Số chứng minh thư" value="{{ old('identity_-card') }}">
                                    {{-- @if ($errors->has('phone'))  --}}
                                    <span class="help-block">
                                        <strong>{{ $errors->first('identity_card') }}</strong>
                                    </span>
                                    {{-- @endif  --}}
                                </div>
                                <div class="form-group">
                                    <lable for="password">Password:</lable>
                                    <input type="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}">
                                    {{-- @if ($errors->has('password'))  --}}
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    {{-- @endif  --}}
                                </div>
                                <div class="form-group">
                                    <lable for="password_confirm">Password confirm:</lable>
                                    <input type="password" name="password_confirm" class="form-control" placeholder="Nhập lại password" value="{{ old('password_confirm') }}">
                                    {{-- @if ($errors->has('password'))  --}}
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirm') }}</strong>
                                    </span>
                                    {{-- @endif  --}}
                                </div>

                                <div class="form-group">
                                    <a class="btn btn-primary" href="{{ Route('view_all_user') }}" type="submit" title="Cancel">Hủy</a>
                                    <button class="btn btn-success">Tạo</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
</div>
@endsection