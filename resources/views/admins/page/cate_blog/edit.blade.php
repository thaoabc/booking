@extends('admins.layout.master-layout')
@section('title')
    Sửa loại tin tức
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1>
                    Sửa loại tin tức
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Sửa loại tin tức</li>
                </ol>
            </section>
            <br>
            <div class="box box-primary">

                <form role="form" method="POST" action="{{ url('admin/cate_blog/process_update_cate_blog/'.$cate_blog->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                        <label for="name">Tên loại tin tức:</label>
                            <input type="text" class="form-control" id="name" name="name_cateblog" placeholder="Nhập tiêu đề" value="{{ $cate_blog->name_cateblog }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Sửa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection