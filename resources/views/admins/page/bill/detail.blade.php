@extends('admins.layout.master-layout')
@section('title')
Chi tiết hóa đơn
@endsection
@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <style>
            .input {
                background: none;
                border: none;
            }
        </style>
        <section class="content-header">
            <h1>
                Chi tiết hóa đơn
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ Route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ Route('chua_nhan_phong') }}"><i class="fa fa-dashboard"></i> Danh sách hóa đơn</a></li>
                <li class="active">Chi tiết hóa đơn</li>
            </ol>
        </section>
        <section class="content">
            <div class="table-responsive">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="contact-text">
                            <h3 style="padding-bottom:50px">Profile Info</h3>
                            <table>
                                </body>
                                <tr>
                                    <td class="c-o">Loại phòng:</td>
                                    <td>{{$detail_bill->name}}</td>
                                </tr>
                                <tr>
                                    <td class="c-o">Giá phòng:</td>
                                    <td>{{$detail_bill->price}}</td>
                                </tr>
                                <tr>
                                    <td class="c-o">Số phòng:</td>
                                    <td>{{$detail_bill->name_room}}</td>
                                </tr>
                                <tr>
                                    <td class="c-o">Ngày nhận:</td>
                                    <td>{{$detail_bill->check_in}}</td>
                                </tr>
                                <tr>
                                    <td class="c-o">Ngày trả:</td>
                                    <td>{{$detail_bill->check_out}}</td>
                                </tr>
                                <tr>
                                    <td class="c-o">Số ngày:</td>
                                    <td>{{$detail_bill->day}}</td>
                                </tr>
                                <tr>
                                    <td class="c-o">Số lượng phòng:</td>
                                    <td>{{$detail_bill->amount}}</td>
                                </tr>
                                <tr>
                                    <td class="c-o">Tổng hóa đơn:</td>
                                    <td>
                                        @if(Session::get('website_language')=="vi")
                                        {{$detail_bill->total_billed_vi}} VND
                                        @else
                                        {{$detail_bill->total_billed_en}} VND
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="c-o">Tình trạng:</td>
                                    @if($detail_bill->status==1)
                                    <td>Chưa nhận phòng</td>
                                    @elseif($detail_bill->status==2)
                                    <td>Đang sử dụng</td>
                                    @else
                                    <td>Đã trả phòng</td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>

@endsection