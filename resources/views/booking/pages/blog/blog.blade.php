@extends('booking.layout.master-layout')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Blog</h2>
                        <div class="bt-option">
                            <a href="./home.html">Home</a>
                            <span>Blog Grid</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog-section blog-page spad">
        <div class="container">
            <div class="row">
                @foreach($blogs as $value)
                <div class="col-lg-4 col-md-6">
                    <div class="blog-item set-bg" data-setbg="assets/sona/img/blog/blog-1.jpg">
                        <div class="bi-text">
                            <span class="b-tag">{{$value->name_cateblog}}</span>
                            <h4><a href="{{ url('detail_blog/'. $value->id) }}">{{$value->name_blog}}</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> {{$value->created_at}}</div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-lg-12">
                    <div class="load-more">
                        <a href="#" class="primary-btn">Load More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection