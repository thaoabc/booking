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
                <div class="box box-default" id="box_thue_tiep" style="display:none">
                    <div class="box-header with-border">
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">

                                <form role="form" method="get" action="{{ route('thue_tiep') }}">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="check_out">Ngày trả phòng:</label>
                                            <input type='date' class="form-control" name="check_out" />
                                            @if ($errors->has('check_out'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('check_out') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                        </select>
                                    </div>
                                    <input type='hidden' class="form-control" id="bill_id" name="bill_id" value="" />
                                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                                </form>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
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
                                            <th>Thuê tiếp</th>
                                            <th>Thanh toán</th>
                                        @endif	
                                        <th>Chi tiết</th>		
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($array_bill as $value)
                                        <tr class="odd gradeX" align="center">
                                           <td>{{$value->name_user}}</td>
                                        <td>{{$value->check_in}}</td>
                                        <td>{{$value->check_out}}</td>
                                        <td>{{$value->day}}</td>
                                        <td>{{$value->amount}}</td>
                                        <td>{{$value->total_billed}}</td>
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
                                         <td><button id="1" onClick="reply_click({{$value->bill_id}})" class="btn btn-success a-btn-slide-text">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            <span><strong>Thuê tiếp</strong></span></button>
                                            </td>
                                        <td><a href="{{route('thanh_toan',['id'=>$value->bill_id])}}" class="btn btn-success a-btn-slide-text">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            <span><strong>Thanh toán</strong></span>            
                                        </a></td>
                                        
                                        @endif
                                        <td><a href="{{route('chi_tiet',['id'=>$value->bill_id])}}" class="btn btn-success a-btn-slide-text">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            <span><strong>Chi tiết</strong></span>            
                                        </a></td>
                                    </tr>
                                    @endforeach
                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
                <script type="text/javascript">
                function reply_click(bill_id)
                {
                    document.getElementById("box_thue_tiep").style.display = "block";
                    document.getElementById("bill_id").value = bill_id;
                }

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