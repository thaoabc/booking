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
                    Danh Sách Dịch vụ
                </h1>
                <ol class="breadcrumb">
                <li><a href="{{ Route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Danh sách dịch vụ</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <a href="{{route('view_insert_service')}}" class="btn btn-success">Thêm dịch vụ</a>
                            </div>
                            <div class="box-header">

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Tên dịch vụ</th>
                                        <th>Nội dung</th>
                                        <th class="col-md-3">Hành động</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($services as $value)
                                        <tr class="odd gradeX" align="center">
                                            <td>{{$value->name_service}}</td>                                            <td>{!!$value->content!!}</td>
                                            
                                            <td>
                                                {{--<a class="btn btn-primary" id="bt{{$value->id}}" style="display: block" onclick="thaotac({{$value->id}})" >Thao tác</a>--}}
                                                <div id="button{{$value->id}}">
                                                    <a class="btn btn-primary" id="edit"
                                                       href="{{ url('admin/services/view_one_service/'.$value->id) }}"
                                                       onclick="">Sửa</a>
                                                    <a class="btn btn-danger"
                                                       href="{{ url('admin/services/delete_service/'.$value->id) }}"
                                                       onclick="return confirm('Hành động sẽ xóa loại phòng này! bạn có muốn tiếp tục?')">Xóa</a>
                                                </div>


                                        </tr>
                                    @endforeach
                                    </tbody>


                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->`
            </section>
            <script>
                {{--function thaotac(id) {--}}
                {{--document.getElementById("button"+id).style.display = 'block';--}}
                {{--document.getElementById("bt"+id).style.display = 'none';--}}
                {{--}--}}

                function update(id) {
                    var input = document.querySelector('#name' + id);
                    var edit = document.querySelector('#edit' + id);
                    var active = document.querySelector('#active' + id);


                    input.removeAttribute('readonly');
                    input.classList.remove('input');
                    input.classList.add('form-control');
                    edit.classList.add('hide');
                    active.classList.remove('hide');
                }

                function huyupdate(id) {
                    var r = confirm("WARNING! You have unsaved changes that may be lost!");
                    if (r == true) {
                        var input = document.querySelector('#name' + id);
                        var edit = document.querySelector('#edit' + id);
                        var active = document.querySelector('#active' + id);


                        input.classList.add('input');
                        $('.input').prop('readonly', true);
                        input.classList.remove('form-control');
                        edit.classList.remove('hide');
                        active.classList.add('hide');

                    } else {
                        return false;
                    }
                }
            </script>
        </div>
    </div>


@endsection