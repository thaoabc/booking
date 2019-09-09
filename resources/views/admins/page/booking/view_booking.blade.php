@extends('admins.layout.master-layout')
@section('title')
    Đặt phòng
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1>
                    Đặt phòng.
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Đặt phòng</li>
                </ol>
            </section>
            <section class="content">
            <div class="box box-primary">

                <form role="form" method="POST" action="{{route('view_phong')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                        <label for="check_in">Ngày nhận phòng:</label>
                        <input type='date' class="form-control" name="check_in" />
                            @if ($errors->has('check_in'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('check_in') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="check_out">Ngày trả phòng:</label>
                            <input type='date' class="form-control" name="check_out" />
                            @if ($errors->has('check_out'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('check_out') }}</strong>
                                </span>
                            @endif
                            
                        </div>
                        <div>
                            <label for="loai_phong">Loại phòng:</label>
                            <select class="form-control" name="cate_id">
                               @foreach ($cate_room as $value)
                                   <option value='{{$value->id}}'>{{$value->name}}_( {{$value->price}} VND )</option>
                               @endforeach
                               
                            </select>
                        </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Tìm phòng</button>
                    </div>
                </form>
            </div>
            </section>
        </div>
    </div>
@endsection