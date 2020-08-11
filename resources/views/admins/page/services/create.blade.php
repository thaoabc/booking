@extends('admins.layout.master-layout')
@section('title')
    Thêm dịch vụ
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1>
                    Thêm dịch vụ.
                </h1>
                <ol class="breadcrumb">
                <li><a href="{{ Route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ Route('view_all_service') }}"><i class="fa fa-umbrella"></i> Danh sách dịch vụ</a></li>
                    <li class="active">Thêm dịch vụ</li>
                </ol>
            </section>
            <br>
            <div class="box box-primary">

                <div class="box-header">
                    <a style="text-align: right;" href="{{route('view_all_service')}}" class="btn btn-primary">Danh sách</a>
                </div>
                <form role="form" method="POST" action="{{route('process_insert_service')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                        <label for="name">Tên dịch vụ:</label>
                            <input type="text" class="form-control" id="name" name="name_service">
                            @if ($errors->has('name_service'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nội dung(*)</label>
                            <textarea name="content" rows="10" placeholder="Nhập nội dung"
                                        class="form-control">{{ old('content') }}</textarea>
                             @if ($errors->has('content'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                        <label for="name_class">Tên class:</label>
                            <input type="text" class="form-control" id="name" name="name_class">
                            @if ($errors->has('name_class'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name_class') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Ảnh nền</label>
                            <input type="file" id="image" name="image" onchange="showIMG()">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" style="margin-left: 10px"> Ảnh hiển thị : </label>
                        <div id="viewImg">

                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
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