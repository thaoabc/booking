@extends('admins.layout.master-layout')
@section('title')
Thêm tin tức
@endsection

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <section class="content-header">
            <h1>
                Thêm tin tức.
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ Route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ Route('view_all_blog') }}"><i class="fa fa-file-text-o"></i> Danh sách tin tức</a></li>
                <li class="active">Thêm tin tức</li>
            </ol>
        </section>
        <br>
        <div class="box box-primary">

            <div class="box-header">
                <a style="text-align: right;" href="{{route('view_all_blog')}}" class="btn btn-primary">Danh sách</a>
            </div>
            <form role="form" method="POST" action="{{route('process_insert_blog')}}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Tên tin tức:</label>
                        <input type="text" class="form-control" id="name" name="name_blog">
                        @if ($errors->has('name_blog'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name_blog') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="name">Loại tin tức:</label>
                        <select class="form-control" name="cate_id">
                            @foreach ($cate_blog as $value)
                            <option value='{{$value->id}}'>{{$value->name_cateblog}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nội dung(*)</label>
                        <textarea name="content" rows="10" placeholder="Nhập nội dung" class="form-control">{{ old('content') }}</textarea>
                        @if ($errors->has('describe'))
                        <span class="help-block">
                            <strong>{{ $errors->first('content') }}</strong>
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
        {{-- CKEDITOR.replace('describe', {
                    filebrowserBrowseUrl: '{{asset("")}}ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '{{asset("")}}ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl: '{{asset("")}}ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl: '{{asset("")}}ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '{{asset("")}}ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: '{{asset("")}}ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        }); --}}


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
        document.getElementById('viewImg').innerHTML = '<img style="width:100px; height: 100px;" src="' + e.target.result + '" />';
        };
        reader.readAsDataURL(fileInput.files[0]);
        }
        }
        }

        </script>
    </div>
</div>
@endsection