@extends('booking.layout.master-layout')

@section('content')
<section class="blog-details-hero set-bg" data-setbg="{{asset('assets/blog').'/'.$blog->image }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="bd-hero-text">
                        <span>{{$blog->name_cateblog}}</span>
                        <h2 style="color:#707079">{{$blog->name_blog}}n</h2>
                        <ul>
                            <li class="b-time"><i class="icon_clock_alt"></i> {{$blog->created_at}}</li>
                            <li><i class="icon_profile"></i> Kerry Jones</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="blog-details-text">
                    <div class="bd-title">
                        <p style="color:#232121">{!!$blog->content!!}</p>
                    </div>
                        <div class="bd-pic">
                            <div class="bp-item">
                                <img src="assets/sona/img/blog/blog-details/blog-details-1.jpg" alt="">
                            </div>
                            <div class="bp-item">
                                <img src="assets/sona/img/blog/blog-details/blog-details-2.jpg" alt="">
                            </div>
                            <div class="bp-item">
                                <img src="assets/sona/img/blog/blog-details/blog-details-3.jpg" alt="">
                            </div>
                        </div>
                        <div class="tag-share">
                            <div class="tags">
                                @foreach($cate_blogs as $value)
                                <a href="{{ url('type_blog/'. $value->id)}}">{{$value->name_cateblog}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    <!-- Recommend Blog Section Begin -->
    <section class="recommend-blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Recommended</h2>
                    </div>
                </div>
            </div>
            <div class="row">
            @foreach($blogs as $value)
                <div class="col-md-4">
                    <div class="blog-item set-bg" data-setbg="{{asset('assets/blog').'/'.$value->image }}">
                        <div class="bi-text">
                            <span class="b-tag">{{$value->name_cateblog}}</span>
                            <h4><a href="{{ url('detail_blog/'. $value->id) }}">{{$value->name_blog}}</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> {{$value->created_at}}</div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>
    <!-- Recommend Blog Section End -->

@endsection