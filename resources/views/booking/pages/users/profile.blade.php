@extends('booking.layout.master-layout')
@section('content')
<!-- Contact Section Begin -->
<section class="contact-section spad">
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
            <li><a data-toggle="tab" href="#edit_profile">Edit Info</a></li>
            <li><a data-toggle="tab" href="#booking_history">Booking History</a></li>
        </ul>
        <div class="tab-content">
            <div id="profile" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="contact-text">
                            <h3 style="padding-bottom:50px">Profile Info</h3>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="c-o">Name:</td>
                                        <td>{{$users->name_user}}</td>
                                    </tr>
                                    <tr>
                                        <td class="c-o">Phone:</td>
                                        <td>{{$users->phone}}</td>
                                    </tr>
                                    <tr>
                                        <td class="c-o">Email:</td>
                                        <td>{{$users->email}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="edit_profile" class="tab-pane fade">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Edit Profile</h3>
                                </div>
                                <div class="box-body chart-responsive" id="box_body_profile">
                                    <form action="{{ Route('process_update_user',['id' => $users->id]) }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <p class="text-body custom-control-p">Tên</p>
                                            <input name="name" class="form-control" type="text" placeholder="Tên" value="{{ $users->name }}">
                                            <p style="color:red">{{ $errors->first('name') }}</p>
                                        </div>

                                        <div class="form-group">
                                            <p class="text-body custom-control-p">Email</p>
                                            <input name="email" class="form-control" type="email" placeholder="Email" value="{{ $users->email }}" />
                                            <p style="color:red">{{ $errors->first('email') }}</p>
                                        </div>
                                        <div class="form-group">
                                            <p class="text-body custom-control-p">Số điện thoại</p>
                                            <input name="phone" class="form-control" type="tel" placeholder="Telephone" value="{{ $users->phone }}" />
                                            <p style="color:red">{{ $errors->first('phone') }}</p>
                                        </div>

                                        <div class="form-group">
                                            <lable for="phone">Chứng minh thư:</lable>
                                            <input type="text" name="identity_card" class="form-control" placeholder="Số chứng minh thư" value="{{ $users->identity_card }}">
                                            {{-- @if ($errors->has('phone'))  --}}
                                            <span class="help-block">
                                                <strong>{{ $errors->first('identity_card') }}</strong>
                                            </span>
                                            {{-- @endif  --}}
                                        </div>
                                        <div v-if='showChangePassword'>
                                            <div class="form-group">
                                                <p class="text-body custom-control-p">Mật khẩu mới</p>
                                                <input name="password" class="form-control" type="password" placeholder="Password">
                                                <p style="color:red">{{ $errors->first('password') }}</p>
                                            </div>
                                            <div class="form-group">
                                                <p class="text-body custom-control-p">Nhập lại mật khẩu</p>
                                                <input name="password_confirm" class="form-control" type="password" placeholder="Confirm password">
                                                <p style="color:red">{{ $errors->first('password_confirm') }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a class="btn btn-primary" href="{{ Route('view_all_user') }}" type="submit" title="Cancel">Hủy</a>
                                            <button class="btn btn-success">Cập nhật</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="booking_history" class="tab-pane fade">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="contact-text">
                            <h3 style="padding-bottom:50px">Booking History</h3>
                            @if(empty($your_booking))
                            <div class="form-group">
                                <p class="text-body custom-control-p">Bạn chưa có thông tin đặt phòng</p>
                            </div>
                            @else
                            @foreach($your_booking as $info)
                            <div class="book_history">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="c-o">Loại phòng:</td>
                                            <td>{{$info->name}}</td>
                                        </tr>
                                        <tr>
                                            <td class="c-o">Giá phòng:</td>
                                            <td>{{$info->price}}</td>
                                        </tr>
                                        <tr>
                                            <td class="c-o">Số phòng:</td>
                                            <td>{{$info->name_room}}</td>
                                        </tr>
                                        <tr>
                                            <td class="c-o">Ngày nhận:</td>
                                            <td>{{$info->check_in}}</td>
                                        </tr>
                                        <tr>
                                            <td class="c-o">Ngày trả:</td>
                                            <td>{{$info->check_out}}</td>
                                        </tr>
                                        <tr>
                                            <td class="c-o">Số ngày:</td>
                                            <td>{{$info->day}}</td>
                                        </tr>
                                        <tr>
                                            <td class="c-o">Số lượng phòng:</td>
                                            <td>{{$info->amount}}</td>
                                        </tr>
                                        <tr>
                                            <td class="c-o">Tổng hóa đơn:</td>
                                            <td>
                                                @if(Session::get('website_language')=="vi")
                                                {{$info->total_billed_vi}} VND
                                                @else
                                                {{$info->total_billed_en}} VND
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="c-o">Tình trạng:</td>
                                            @if($info->status==1)
                                            <td>Chưa nhận phòng</td>
                                            @elseif($info->status==2)
                                            <td>Đang sử dụng</td>
                                            @else
                                            <td>Đã trả phòng</td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>

<script src="{{ asset('') }}admins/dist/js/adminlte.min.js"></script>
<!-- Contact Section End -->
@endsection