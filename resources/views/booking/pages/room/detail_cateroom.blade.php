@extends('booking.layout.master-layout')

@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Thông tin phòng</h2>
                    <div class="bt-option">
                        <a href="{{route('index')}}">Trang chủ</a>
                        <span>Rooms</span>
                    </div>
                </div>
            </div>
        </div>
        @if ( Session::has('success') )
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
        @elseif(Session::has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>{{ Session::get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
        @endif
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Room Details Section Begin -->
<section class="room-details-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="room-details-item">
                    <img src="{{asset('assets/detail_room').'/'.$room->image_detail}}" alt="">
                    <div class="rd-text">
                        <div class="rd-title">
                            <h3>{{$room->name}}</h3>
                        </div>
                        <h2>{{number_format ($room->price)}}VND<span>/Đêm</span></h2>
                        {!! $room->describe !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="room-booking">
                    <h3>Đặt phòng cho bạn</h3>
                    <form role="form" method="POST" action="{{ url('detail_cateroom/'. $room->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="check-date">
                            <label for="check_in">Ngày nhận:</label>
                            <input type="text" class="date-input" name="check_in" id="date-in" autocomplete="off">
                            <i class="icon_calendar"></i>
                        </div>
                        @if ($errors->has('check_in'))
                        <span class="help-block">
                            <strong>{{ $errors->first('check_in') }}</strong>
                        </span>
                        @endif
                        <div class="check-date">
                            <label for="check_out">Ngày trả:</label>
                            <input type="text" class="date-input" name="check_out" id="date-out" autocomplete="off">
                            <i class="icon_calendar"></i>
                        </div>
                        @if ($errors->has('check_out'))
                        <span class="help-block">
                            <strong>{{ $errors->first('check_out') }}</strong>
                        </span>
                        @endif
                        <div class="select-option">
                            <label for="room">Số phòng:</label>
                            <select name="amount_room">
                                @for($i=1;$i<=$amount_room;$i++)
                                    <option value="{{ $i }}">{{ $i }} phòng</option>
                                @endfor
                            </select>
                        </div>
                        <button type="submit">Đặt phòng ngay</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Room Details Section End -->
@endsection