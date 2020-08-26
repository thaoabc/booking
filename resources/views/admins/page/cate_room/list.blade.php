@extends('admins.layout.master-layout')
@section('title')
    Danh sách loại phòng
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
                    Danh Sách Loại Phòng
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ Route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="active">Loại phòng</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <a href="{{route('view_insert_loai_phong')}}" class="btn btn-success">Thêm loại phòng</a>
                            </div>
                            <div class="box-header">

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Tên loại phòng</th>
                                        <th>Ảnh</th>
                                        <th>Ảnh chi tiết</th>
                                        <th>Giá</th>
                                        <th>Mô tả</th>
                                        <th class="col-md-3">Hành động</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cate_room as $value)
                                        <tr class="odd gradeX" align="center">
                                            <td>{{$value->name}}</td>
                                            <td><img width="100px" height="100px" src="{{asset('assets/cate_room').'/'.$value->image }}"></td>
                                            <td><img width="100px" height="100px" class="img-fluid" src="{{asset('assets/detail_room').'/'.$value->image_detail }}"></td>
                                            <td>{{$value->price}}</td>
                                            <td>{!! $value->describe !!}</td>
                                            
                                            <td>
                                                <div id="button{{$value->id}}">
                                                    <a class="btn btn-primary" id="edit"
                                                       href="{{ url('admin/loai_phong/view_one_loai_phong/'.$value->id) }}"
                                                       onclick="">Sửa</a>
                                                    <a class="btn btn-danger"
                                                       href="{{ url('admin/loai_phong/delete_loai_phong/'.$value->id) }}"
                                                       onclick="return confirm('Hành động sẽ xóa loại phòng này! bạn có muốn tiếp tục?')">Xóa</a>
                                                </div>


                                        </tr>
                                    @endforeach
                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


@endsection