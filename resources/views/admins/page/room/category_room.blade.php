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
                        <img width="100px" src="{{asset('assets/cate_room').'/'.$value->image }}">
                            <div class="ri-text">
                                <h4>{{$value->name}}</h4>
                                <h3>{{$value->price}}<span>/Pernight</span></h3>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="r-o">Size:</td>
                                            <td>30 ft</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Capacity:</td>
                                            <td>Max persion 3</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Bed:</td>
                                            <td>King Beds</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Services:</td>
                                            <td>Wifi, Television, Bathroom,...</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="{{ url('detail_room/'. $value->id) }}" class="primary-btn">More Details</a>
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