@extends('booking.layout.master-layout')

@section('content')
<div class="content-wrapper">
        <div class="container-fluid">
        <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-text">
                        <h1>Sona A Luxury Hotel</h1>
                        <p>Here are the best hotel booking sites, including recommendations for international
                            travel and for finding low-priced hotel rooms.</p>
                        <a href="#hp-room-section" class="primary-btn">Discover Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="assets/sona/img/hero/hero-1.jpg"></div>
            <div class="hs-item set-bg" data-setbg="assets/sona/img/hero/hero-2.jpg"></div>
            <div class="hs-item set-bg" data-setbg="assets/sona/img/hero/hero-3.jpg"></div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- About Us Section Begin -->
    <section class="aboutus-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text">
                        <div class="section-title">
                            {!!$contact->website!!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-pic">
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="assets/sona/img/about/about-1.jpg" alt="">
                            </div>
                            <div class="col-sm-6">
                                <img src="assets/sona/img/about/about-2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Section End -->

    <!-- Services Section End -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>What We Do</span>
                        <h2>Discover Our Services</h2>
                    </div>
                </div>
            </div>
            <div class="row">
            @foreach($services as $value)

                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="{{$value->name_class}}"></i>
                        <h4>{{$value->name_service}}</h4>
                        <p>{!!$value->content!!}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Home Room Section Begin -->
    <section class="hp-room-section" id="hp-room-section">
        <div class="container-fluid">
            <div class="hp-room-items">
                <div class="row">
                @foreach($cate_room as $value)
                    <div class="col-lg-3 col-md-6">
                    <div class="hp-room-item set-bg" width="360px" height="234px" data-setbg="{{asset('assets/cate_room').'/'.$value->image }}">
                            <div class="hr-text">
                                <h4>{{$value->name}}</h4>
                                <h3>{{number_format($value->price)}}<span>/Pernight</span></h3>
                                {!! $value->describe !!}
                                <a href="{{ url('detail_cateroom/'. $value->id) }}" class="primary-btn">More Details</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Home Room Section End -->

    <!-- Testimonial Section Begin -->
    {{--  <section class="testimonial-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Testimonials</span>
                        <h2>What Customers Say?</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="testimonial-slider owl-carousel">
                        <div class="ts-item">
                            <p>After a construction project took longer than expected, my husband, my daughter and I
                                needed a place to stay for a few nights. As a Chicago resident, we know a lot about our
                                city, neighborhood and the types of housing options available and absolutely love our
                                vacation at Sona Hotel.</p>
                            <div class="ti-author">
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <h5> - Alexander Vasquez</h5>
                            </div>
                            <img src="assets/sona/img/testimonial-logo.png" alt="">
                        </div>
                        <div class="ts-item">
                            <p>After a construction project took longer than expected, my husband, my daughter and I
                                needed a place to stay for a few nights. As a Chicago resident, we know a lot about our
                                city, neighborhood and the types of housing options available and absolutely love our
                                vacation at Sona Hotel.</p>
                            <div class="ti-author">
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <h5> - Alexander Vasquez</h5>
                            </div>
                            <img src="assets/sona/img/testimonial-logo.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>  --}}
    <!-- Testimonial Section End -->

    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Hotel News</span>
                        <h2>Our Blog & Event</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($blogs as $value)
                <div class="col-lg-4">
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
        </div>
    </div>

@endsection