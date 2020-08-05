@extends('admins.layout.master-layout')
@section('title')
    Sửa tin tức
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1>
                    Sửa tin tức
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Sửa tin tức</li>
                </ol>
            </section>
            <br>
            <div class="box box-primary">

                <form role="form" method="POST" action="{{ url('admin/blog/process_update_blog/'.$blog->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                        <label for="name">Tên tin tức:</label>
                            <input type="text" class="form-control" id="name" name="name_blog" placeholder="Nhập tiêu đề" value="{{ $blog->name_blog }}">
                            @if ($errors->has('name_blog'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name_blog') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="cate_id">Loại tin tức:</label>
                            <select class="form-control" name="cate_id">
                                @foreach ($cate_blog as $value)
                                   <option value='{{$value->id}}'>{{$value->name_cateblog}}</option>
                                @endforeach
                               
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="status">Tình trạng:</label>
                            <select class="form-control" name="status">
                                <option value="1">Đã đăng</option>
                                <option value="0">Lưu nháp</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nội dung(*)</label>
                            <textarea name="content" rows="10" placeholder="Nhập nội dung" class="form-control">{{$blog->content}}</textarea>
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
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
            </div>

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