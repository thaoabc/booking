@extends('admins.layout.master-layout')
@section('title')
    Danh sách phòng
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
                    Danh Sách Phòng
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Phòng</li>
                </ol>
            </section>
            <section class="content">
            @if(($room->count())==0)
                <h3>Không có kết quả nào được tìm thấy</h3>
                <div class="box-footer">
                    <button type="submit" id="search_room" onclick="search_room()" class="btn btn-primary">Bạn có muốn tìm loại phòng khác</button>
                </div>
                <div id="result"></div>
            @else
            <div class="box box-primary">

                <form role="form" method="post" action="{{route('dat_phong')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <input type='hidden' class="form-control" name="check_in" value="{{$array_date['check_in']}}" />
                        </div>
                        <div class="form-group">
                            <input type='hidden' class="form-control" name="check_out" value="{{$array_date['check_out']}}"/>
                        </div>
                        <div class="box-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Tên phòng </th>
                                        <th>Hành Động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($room))
                                        @foreach($room as $key => $value )
                                            <tr class="gradeX">
                                                <td>{{ $value->name }}</td>
                                                <td >
                                                    <button class="btn btn-primary" href="#" name="id" value={{$value->id}} title="Chọn phòng"><i class="fas fa-pencil-ruler"></i> Chọn</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>


                                </table>
                            </div>
                        {{--  <div class="form-group">
                            <label for="tinh_trang">Tên phòng:</label>
                            <select class="form-control" name="id">
                                @foreach ($room as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>  --}}
                        {{--  <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Đặt phòng</button>
                        </div>  --}}
                </form>
            </div>
            @endif
            </section>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
	
	function search_room(){
                $.ajax({
                    url : "result.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	 _token : '{{ csrf_token() }}',
                        number : $('#number').val(),
                        id_pending: id_pending,
                        id: id_web,
                    },
                    success : function (ketqua){
                        $('#result').html(ketqua);
                    }
                });
            }
</script>

@endsection