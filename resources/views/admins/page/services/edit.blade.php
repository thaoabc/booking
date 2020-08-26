@extends('admins.layout.master-layout')
@section('title')
Sửa dịch vụ
@endsection

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <section class="content-header">
            <h1>
                Sửa dịch vụ
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ Route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ Route('view_all_service') }}"><i class="fa fa-umbrella"></i> Danh sách dịch vụ</a></li>
                <li class="active">Sửa dịch vụ</li>
            </ol>
        </section>
        <br>
        <div class="box box-primary">

            <form role="form" method="POST" action="{{ url('admin/services/process_update_service/'.$services->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Tên dịch vụ:</label>
                        <input type="text" class="form-control" id="name" name="name_service" placeholder="Nhập tiêu đề" value="{{ $services->name_service }}">
                        @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nội dung(*)</label>
                        <textarea name="content" rows="10" placeholder="Nhập nội dung" class="form-control">{{$services->content}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên class(*)</label>
                        <input name="name_class" type="text" class="form-control" placeholder="Nhập class" class="form-control" value="{{$services->name_class}}">
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Sửa</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection