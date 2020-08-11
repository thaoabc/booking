@extends('admins.layout.master-layout')
@section('title')
Sửa loại phòng
@endsection

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <section class="content-header">
            <h1>
                Sửa loại phòng
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ Route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ Route('view_all_loai_phong') }}"><i class="fa  fa-building"></i> Danh sách loại phòng</a></li>
                <li class="active">Sửa loại phòng</li>
            </ol>
        </section>
        <br>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <a style="text-align: right;" href="{{route('view_all_loai_phong')}}" class="btn btn-primary">Danh sách</a>
                        </div>
                        <div class="box-body">
                            <div class="box box-primary">

                                <form role="form" method="POST" action="{{ url('admin/loai_phong/process_update_loai_phong/'.$cate_room->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="name">Tên loại phòng:</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tiêu đề" value="{{ $cate_room->name }}">
                                            @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Giá</label>
                                            <input type="text" class="form-control" id="price" name="price" placeholder="Nhập tiêu đề" value="{{ $cate_room->price }}">
                                            @if ($errors->has('price'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mô tả(*)</label>
                                            <textarea id="content" name="describe" rows="10" cols="80" placeholder="Nhập nội dung">
                            {!! $cate_room->describe !!}
                        </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Ảnh nền</label>
                                            <input type="file" id="image" name="image" onchange="showIMG()">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" style="margin-left: 10px"> Ảnh hiển thị : </label>
                                        <div id="viewImg">

                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Sửa</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            CKEDITOR.replace('contentt', {
                filebrowserBrowseUrl: '{{asset("")}}ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl: '{{asset("")}}ckfinder/ckfinder.html?type=Images',
                filebrowserFlashBrowseUrl: '{{asset("")}}ckfinder/ckfinder.html?type=Flash',
                filebrowserUploadUrl: '{{asset("")}}ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl: '{{asset("")}}ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                filebrowserFlashUploadUrl: '{{asset("")}}ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
            });


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
                        reader.onload = function(e) {
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