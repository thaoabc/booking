@extends('admin.layouts.master-layouts')
@section('title')
    Thêm tin tức
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <section class="content-header">
            <h1>
                Thêm thể loại tin tức.
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Thêm thể loại tin tức</li>
            </ol>
        </section>
        <br>
        <div class="box box-primary">

            <form role="form" method="POST" action="{{route('news.storeCate')}}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Thêm thể loại  (*)</label>
                        <input type="text" class="form-control" placeholder="Nhập tiêu đề" name="name"
                               value="{{ old('name') }}" required>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </form>
                <section class="content" style="margin-bottom: 50px">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    {{--<a class="btn btn-primary" id="btnadd" href="{{ route('add.products') }}" onclick="">Thêm Sản phẩm</a>--}}
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Tên </th>
                                            <th>Thời gian </th>
                                            <th>Hành động</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cate_news as $value)
                                            <tr class="odd gradeX" align="center">
                                                <td>{{$value->name}}</td>
                                                <td>{{$value->created_at}}</td>

                                                <td>

                                                    <a class="btn btn-primary" id="edit{{ $value->id }}" href="{{ url('admincp/news/edit-cate/'.$value->id) }}" onclick="">Sửa</a>
                                                    <a class="btn btn-danger" href="{{ url('admincp/news/destroy-cate/'.$value->id) }}" onclick="return confirm('Hành động sẽ xóa tin tức này! bạn có muốn tiếp tục?')">Xóa</a>
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
                    <!-- /.row -->
                </section>
        </div>

    
        <script>

    
    
            function showIMG() {
                var fileInput = document.getElementById('image');
                var filePath = fileInput.value; //lấy giá trị input theo id
                var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i; //các tập tin cho phép
                //Kiểm tra định dạng
                if (!allowedExtensions.exec(filePath)) {
                    alert('Bạn chỉ có thể dùng ảnh dưới định dạng .jpeg/.jpg/.png/.gif extension.');
                    fileInput.value = '';
                    return false;
                } else {
                    //Image preview
                    if (fileInput.files && fileInput.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            document.getElementById('viewImg').innerHTML = '<img style="width:100px; height: 100px;" src="' + e.target.result + '"/>';
                        };
                        reader.readAsDataURL(fileInput.files[0]);
                    }
                }
            }
    
        </script>
    </div>
</div>


@endsection