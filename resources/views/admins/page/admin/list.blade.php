@extends('admins.layout.master-layout')
@section('title')
    Danh sách admin
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <style>
                .input{
                    background: none;
                    border: none;
                }
            </style>
            <section class="content-header">
                <h1>
                    Danh sách admin
                </h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <a class="btn btn-primary" id="btnadd" href="{{ route('view_insert_admin') }}" onclick="">Thêm admin</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Chức vụ</th>
                                        <th>Hành Động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($admin))
                                        @foreach($admin as $key => $admin )
                                            <tr class="gradeX">
                                                <td>{{ $admin->name }}</td>
                                                <td>{{ $admin->email }}</td>
                                                <td>{{ $admin->phone }}</td>
                                                @if($admin->level==1)
                                                    <td>Quản trị viên</td>
                                                @else
                                                    <td>Nhân viên</td>
                                                @endif
                                                <td >
                                                    <a class="btn btn-default" href="{{Route('view_one_admin',$admin->id ) }}" title="Edit this user account"><i class="fas fa-pencil-ruler"></i> Sửa</a>
                                                    <a href="{{ Route('delete_admin',$admin->id) }}" class="btn btn-danger" title="Xóa" onclick="return confirm('Bạn muốn xoá địa chỉ này ?')"><i class="fa fa-trash"></i> Xóa</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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
                <!-- /.row -->
            </section>

        </div>
    </div>
@endsection