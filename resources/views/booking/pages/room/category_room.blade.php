@extends('booking.layout.master-layout')

@section('content')

<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Our Rooms</h2>
                    <div class="bt-option">
                        <a href="./home.html">Home</a>
                        <span>Rooms</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->
<div class="content-wrapper">
    <div class="container-fluid">
        <section class="rooms-section spad">
            <div class="container">
                <div class="row">
                    @foreach($cate_room as $value)
                    <div class="col-lg-4 col-md-6">
                        <div class="room-item">
                        <img width="360px" height="234px" src="{{asset('assets/cate_room').'/'.$value->image }}">
                            <div class="ri-text">
                                <h4>{{$value->name}}</h4>
                                <h3>{{$value->price}}<span>/Pernight</span></h3>
                                {!! $value->describe !!}
                                <a href="{{ url('detail_cateroom/'. $value->id) }}" class="primary-btn">More Details</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-lg-12">
                        <div class="room-pagination">
                        {{ $cate_room->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


@endsection