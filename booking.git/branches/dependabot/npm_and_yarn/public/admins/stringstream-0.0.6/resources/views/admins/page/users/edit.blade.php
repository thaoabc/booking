@extends('admins.layout.master-layout')
@section('title')
    Chỉnh sửa tài khoản users
@endsection
@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
        <style>
                .input{
                    background: none;
                    border: none;
                }
            </style>
            <section class="content-header">
                <h1>
                    Chỉnh sửa tài khoản users
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
                    <li><a href="{{ Route('view_all_user') }}"><i class="fa fa-dashboard"></i> Tài khoản users</a></li>
                    <li class="active">Sửa tài khoản</li>
                </ol>
            </section>
            <section class="content">
                <div class="table-responsive">
                <form action="{{ Route('process_update_user',['id' => $users->id]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <p class="text-body custom-control-p">Tên</p>
                        <input name="name" class="form-control" type="text" placeholder="Tên" value="{{ $users->name }}">
                        <p style="color:red">{{ $errors->first('name') }}</p>
                    </div>

                    <div class="form-group">
                        <p class="text-body custom-control-p">Email</p>
                        <input name="email" class="form-control" type="email" placeholder="Email" value="{{ $users->email }}" />
                        <p style="color:red">{{ $errors->first('email') }}</p>
                    </div>
                    <div class="form-group">
                        <p class="text-body custom-control-p">Số điện thoại</p>
                        <input name="phone" class="form-control" type="tel" placeholder="Telephone" value="{{ $users->phone }}" />
                        <p style="color:red">{{ $errors->first('phone') }}</p>
                    </div>
                    
                    <div class="form-group">
                            <lable for="phone">Chứng minh thư:</lable>
                            <input type="text" name="identity_card" class="form-control" placeholder="Số chứng minh thư" value="{{ $users->identity_card }}">
                            {{--  @if ($errors->has('phone'))  --}}
                                <span class="help-block">
                                    <strong>{{ $errors->first('identity_card') }}</strong>
                                </span>
                            {{--  @endif  --}}
                        </div>
                    <div v-if='showChangePassword'>
                        <div class="form-group">
                            <p class="text-body custom-control-p">Mật khẩu mới</p>
                            <input name="password" class="form-control" type="password" placeholder="Password">
                            <p style="color:red">{{ $errors->first('password') }}</p>
                        </div>
                        <div class="form-group">
                            <p class="text-body custom-control-p">Nhập lại mật khẩu</p>
                            <input name="password_confirm" class="form-control" type="password" placeholder="Confirm password">
                            <p style="color:red">{{ $errors->first('password_confirm') }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-primary" href="{{ Route('view_all_user') }}" type="submit" title="Cancel">Hủy</a>
                        <button class="btn btn-success">Cập nhật</button>
                    </div>
                </form>
            </div>
            </div>  
        </div>
    </div>

@endsection