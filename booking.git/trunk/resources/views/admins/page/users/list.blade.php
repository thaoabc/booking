@extends('admins.layout.master-layout')
@section('title')
    Danh sách users
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
                    Danh sách users
                </h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                             <div class="box-header">
                                <a href="{{route('view_insert_user')}}" class="btn btn-success">Chưa có tài khoản</a>
                            </div>
                             @if ( Session::has('error') )
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <strong>{{ Session::get('error') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                </div>
                            @endif
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Phone</th>
                                        <th>Chứng minh</th>
                                        <th>Email</th>
                                        <th>Hành Động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($users))
                                        @foreach($users as $key => $users )
                                            <tr class="gradeX">
                                                <td>{{ $users->name }}</td>
                                                <td>{{ $users->phone }}</td>
                                                <td>{{ $users->identity_card }}</td>
                                                <td>{{ $users->email }}</td>
                                                <td >
                                                    <a class="btn btn-default" href="{{Route('view_one_user',$users->id ) }}" title="Edit this user account"><i class="fas fa-pencil-ruler"></i> Sửa</a>
                                                    <a class="btn btn-primary"  href="{{url('admin/dat_phong/view_dat_phong/'.$users->id)}}" title="Edit this user account"><i class="fas fa-pencil-ruler"></i> Đặt phòng</a>
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