@extends('admins.layout.master-layout')
@section('title')
    Thêm dịch vụ
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1>
                    Thêm dịch vụ.
                </h1>
                <ol class="breadcrumb">
                <li><a href="{{ Route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ Route('view_all_service') }}"><i class="fa fa-umbrella"></i> Danh sách dịch vụ</a></li>
                    <li class="active">Thêm dịch vụ</li>
                </ol>
            </section>
            <br>
            <div class="box box-primary">

                <div class="box-header">
                    <a style="text-align: right;" href="{{route('view_all_service')}}" class="btn btn-primary">Danh sách</a>
                </div>
                <form role="form" method="POST" action="{{route('process_insert_service')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                        <label for="name">Tên dịch vụ:</label>
                            <input type="text" class="form-control" id="name" name="name_service">
                            @if ($errors->has('name_service'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nội dung(*)</label>
                            <textarea name="content" rows="10" placeholder="Nhập nội dung"
                                        class="form-control">{{ old('content') }}</textarea>
                             @if ($errors->has('content'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                        <label for="name_class">Tên class:</label>
                            <input type="text" class="form-control" id="name" name="name_class">
                            @if ($errors->has('name_class'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name_class') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection