@extends('admins.layout.master-layout')
@section('title')
    Danh sách hóa đơn
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
                    Danh Sách Hóa Đơn
                </h1>
                 @if ( Session::has('error') )
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <strong>{{ Session::get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                @endif
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Hóa đơn</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <a href="{{route('chua_nhan_phong')}}" class="btn btn-success">Chưa nhận phòng</a>
                                <a href="{{route('dang_su_dung')}}" class="btn btn-success">Đang sử dụng</a>
                                <a href="{{route('da_thanh_toan')}}" class="btn btn-success">Đã thanh toán</a>
                            </div>
                            <div class="box-header">

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Tên khách hàng</th>
                                        <th>Ngày nhận phòng</th>
                                        <th>Ngày trả phòng</th>
                                        <th>Số ngày</th>
                                        <th>Số phòng</th>
                                        <th>Thành tiền</th>
                                        @if($day['status']==1)
                                            <th>Nhận phòng</th>
                                        
                                        @elseif($day['status']==2)
                                            <th>Dừng thuê</th>
                                            <th>Thanh toán</th>
                                        
                                        @endif			
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($array_bill as $value)
                                        <tr class="odd gradeX" align="center">
                                           <td>{{$value->name}}</td>
                                        <td>{{$value->check_in}}</td>
                                        <td>{{$value->check_out}}</td>
                                        <td>{{$value->day}}</td>
                                        <td>{{$value->amount}}</td>
                                        <td>{{$value->total_billed_vi}}</td>
                                        @if($day['status']==1)
                                            <td><a href="{{route('xac_nhan',['id'=>$value->bill_id])}}" class="btn btn-primary a-btn-slide-text">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            <span><strong>Xác nhận</strong></span>            
                                            </a></td>
                                        
                                        @elseif($day['status']==2)
                                            <td><a href="{{route('dung_thue',['id'=>$value->bill_id])}}" class="btn btn-warning a-btn-slide-text">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            <span><strong>Dừng thuê</strong></span>            
                                        </a></td>
                                        <td><a href="{{route('thanh_toan',['id'=>$value->bill_id])}}" class="btn btn-success a-btn-slide-text">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            <span><strong>Thanh toán</strong></span>            
                                        </a></td>
                                        
                                        @endif
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