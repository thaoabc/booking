@extends('admins.layout.master-layout')
@section('title')
    Sửa liên hệ
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1>
                    Sửa liên hệ
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Sửa liên hệ</li>
                </ol>
            </section>
            <br>
            <div class="box box-primary">

                <form role="form" method="POST" action="{{ url('admin/contact/process_update_contact/'.$contact->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                        <label for="title">Tên liên hệ:</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề" value="{{ $contact->title }}">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                        <label for="masothue">Mã số thuế:</label>
                            <input type="text" class="form-control" id="masothue" name="masothue" placeholder="Nhập mã số thuế" value="{{ $contact->masothue }}">
                            @if ($errors->has('masothue'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('masothue') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                        <label for="address">Địa chỉ:</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ" value="{{ $contact->address }}">
                            @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                        <label for="phone">Số điện thoại:</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" value="{{ $contact->phone }}">
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                        <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Nhập email" value="{{ $contact->email }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                        <label for="website">Link website:</label>
                            <input type="text" class="form-control" id="website" name="website" placeholder="Nhập website" value="{{ $contact->website }}">
                            @if ($errors->has('website'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('website') }}</strong>
                                </span>
                            @endif
                        </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Sửa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection