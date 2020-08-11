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

    <!-- Room Details Section Begin -->
    <section class="room-details-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="room-details-item">
                        <img width="750px" height="430px" src="{{asset('assets/cate_room').'/'.$cate_room->image}}" alt="">
                        <div class="rd-text">
                            <div class="rd-title">
                                <h3>{{$cate_room->name}}</h3>
                            </div>
                            <h2>{{$cate_room->price}}VND<span>/Pernight</span></h2>
                            {!! $cate_room->describe !!}
                            <p>The two commonly known recreational vehicle classes are the motorized and towable.
                                Towable rvs are the travel trailers and the fifth wheel. The rv travel trailer or fifth
                                wheel has the attraction of getting towed by a pickup or a car, thus giving the
                                adaptability of possessing transportation for you when you are parked at your campsite.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="room-booking">
                        <h3>Your Reservation</h3>
                        <form role="form" method="POST" action="{{route('view_phong')}}" enctype="multipart/form-data">
                    @csrf
                            <div class="check-date">
                                <label for="date-in">Check In:</label>
                                <input type="text" name="check_in" class="date-input" id="date-in">
                                 @if ($errors->has('check_in'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('check_in') }}</strong>
                                </span>
                            @endif
                                <i class="icon_calendar"></i>
                            </div>
                            <div class="check-date">
                                <label for="date-out">Check Out:</label>
                                <input type="text" name="check_out" class="date-input" id="date-out">
                                @if ($errors->has('check_out'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('check_out') }}</strong>
                                </span>
                            @endif
                                <i class="icon_calendar"></i>
                            </div>
                            <div class="select-option">
                                <label for="guest">Guests:</label>
                                <select id="guest">
                                    <option value="">3 Adults</option>
                                </select>
                            </div>
                            <div class="select-option">
                                <label for="room">Room:</label>
                                <select id="room">
                                    <option value="">1 Room</option>
                                    <option value="">2 Room</option>
                                    <option value="">3 Room</option>
                                    <option value="">4 Room</option>
                                </select>
                            </div>
                            <button type="submit">Check Availability</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Room Details Section End -->
@endsection