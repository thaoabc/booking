@extends('admins.layout.master-layout')
@section('title')
Chỉnh sửa tài khoản admin
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
            <h1>
                Chỉnh sửa tài khoản admin
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
                <li><a href="{{ Route('view_all_admin') }}"><i class="fa fa-dashboard"></i> Tài khoản Admin</a></li>
                <li class="active">Sửa tài khoản</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <a class="btn btn-primary" id="btnadd" href="{{ route('view_all_admin') }}" onclick="">Quay lại</a>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <form action="{{ Route('process_update_admin',['id' => $admin->id]) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <p class="text-body custom-control-p">Tên</p>
                                        <input name="name" class="form-control" type="text" placeholder="Tên" value="{{ $admin->name }}">
                                        <p style="color:red">{{ $errors->first('name') }}</p>
                                    </div>

                                    <div class="form-group">
                                        <p class="text-body custom-control-p">Email</p>
                                        <input name="email" class="form-control" type="email" placeholder="Email" value="{{ $admin->email }}" />
                                        <p style="color:red">{{ $errors->first('email') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <p class="text-body custom-control-p">Số điện thoại</p>
                                        <input name="phone" class="form-control" type="tel" placeholder="Telephone" value="{{ $admin->phone }}" />
                                        <p style="color:red">{{ $errors->first('phone') }}</p>
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
                                        <p class="text-body custom-control-p">Chức vụ</p>
                                        <select name="level">)
                                            <option value=1>Quản lý</option>
                                            <option value=2>Nhân viên</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <a class="btn btn-primary" href="{{ Route('view_all_admin') }}" type="submit" title="Cancel">Hủy</a>
                                        <button class="btn btn-success">Cập nhật</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
</div>

@endsection