@extends('admins.layout.master-layout')
@section('title')
    Thêm liên hệ
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1>
                    Thêm liên hệ.
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Thêm liên hệ</li>
                </ol>
            </section>
            <br>
            <div class="box box-primary">

                <div class="box-header">
                    <a style="text-align: right;" href="{{route('contact.list')}}" class="btn btn-primary">Danh sách</a>
                </div>
                <form role="form" method="POST" action="{{route('process_insert_contact')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                        <label for="title">Tên liên hệ:</label>
                            <input type="text" class="form-control" id="title" name="title">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="masothue">Mã số thuế:</label>
                            <input type="text" class="form-control" id="masothue" name="masothue">
                            @if ($errors->has('masothue'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('masothue') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ:</label>
                            <input type="text" class="form-control" id="address" name="address">
                            @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                        <label for="phone">Số điện thoại:</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" name="email">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="website">Link website:</label>
                            <input type="text" class="form-control" id="website" name="website">
                            @if ($errors->has('website'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('website') }}</strong>
                                </span>
                            @endif
                        </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection