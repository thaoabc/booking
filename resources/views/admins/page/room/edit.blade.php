@extends('admins.layout.master-layout')
@section('title')
Sửa phòng
@endsection

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <section class="content-header">
            <h1>
                Sửa phòng
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ Route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ Route('view_all_phong') }}"><i class="fa  fa-users"></i> Danh sách phòng</a></li>
                <li class="active">Sửa phòng</li>
            </ol>
        </section>
        <br>
        <div class="box box-primary">
            <div class="box-header">
                <a style="text-align: right;" href="{{route('view_all_phong')}}" class="btn btn-primary">Danh sách</a>
            </div>
            <form role="form" method="POST" action="{{ url('admin/phong/process_update_phong/'.$room->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Tên phòng:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tiêu đề" value="{{ $room->name_room }}">
                        @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="cate_id">Loại phòng:</label>
                        <select class="form-control" name="cate_id">
                            @foreach ($cate_room as $value)
                            <option value='{{$value->id}}'>{{$value->name}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Tình trạng:</label>
                        <select class="form-control" name="status">
                            <option value="1">Hoạt động</option>
                            <option value="0">Dừng</option>
                        </select>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
            </form>
        </div>
    </div>
</div>

@endsection