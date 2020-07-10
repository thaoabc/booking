@extends('layer_khach_hang.master')
@section('content')
<div class="row">
  <div class="col-md-6 mx-auto text-center mb-5 section-heading">
    <h2 class="mb-5">Danh Sách Phòng</h2>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-lg-4 mb-5">
    <div class="hotel-room text-center">
      <a href="#" class="d-block mb-0 thumbnail"><img src="images/img_1.jpg" alt="Image" class="img-fluid"></a>
      <div class="hotel-room-body">
        <h3 class="heading mb-0" name="ten_phong"><a href="#">201</a></h3>
        <strong class="price" name="gia">$350.00 / per night</strong>
        <a href="#" class="d-block mb-0 thumbnail"> Xem Chi Tiết Phòng</a>
      </div>
    </div>
  </div>
</div> 
@endsection