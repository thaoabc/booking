@extends('admins.layout.master-layout')
@section('title')
Danh sách tin tức
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
                Danh Sách tin tức
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">tin tức</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <a href="{{route('view_insert_blog')}}" class="btn btn-success">Thêm tin tức</a>
                        </div>
                        <div class="box-header">

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Tên tin tức</th>
                                        <th>Ảnh</th>
                                        <th>Nội dung</th>
                                        <th class="col-md-3">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blog as $value)
                                    <tr class="odd gradeX" align="center">
                                        <td>{{$value->name_blog}}</td>
                                        <td><img width="100px" src="{{asset('assets/blog').'/'.$value->image }}"></td>
                                        <td>{{$value->content}}</td>
                                        <td>
                                            {{--<a class="btn btn-primary" id="bt{{$value->id}}" style="display: block" onclick="thaotac({{$value->id}})" >Thao tác</a>--}}
                                            <div id="button{{$value->id}}">
                                                <a class="btn btn-primary" id="edit" href="{{ url('admin/blog/view_one_blog/'.$value->id) }}" onclick="">Sửa</a>
                                                <a class="btn btn-danger" href="{{ url('admin/blog/delete_blog/'.$value->id) }}" onclick="return confirm('Hành động sẽ xóa tin tức này! bạn có muốn tiếp tục?')">Xóa</a>
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